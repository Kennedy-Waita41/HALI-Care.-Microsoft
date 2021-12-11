<?php
define("HALI_CONFIG", "hali-config.json");

    //hali config
    $haliConfig = json_decode(file_get_contents(HALI_CONFIG));
    //api paths
    $api = $haliConfig->apiPaths;

    //console paths
    $console = $haliConfig->consolePaths;

    /**
     *  
    * makes a class following the convention
    */

  function makeClass($classname, $parentClass, array $interfaces, array $traits, $constructorVisibility = "public", $realEntity = false){
    $api = $GLOBALS['api'];

    $camelCaseClassName = ucwords($classname);
    $classname = strtolower($classname);

    if(file_exists("$api->classes/$classname.class.php")){
      echo "$classname class already exists\n";
      return $camelCaseClassName;
    }
    echo "creating $classname class\n\n";

    $cmd = "touch $api->classes/$classname.class.php";
    $return = false;
    $output = [];
    exec($cmd, $output, $return);
   
    if($return == 0){
      $file = fopen("$api->classes/$classname.class.php", "w");
      $extends = "";
      $implements = "";
      $uses = "";

      if($parentClass != ""){
        $extends = " extends ";
      }

      $implementedInterfaces = "";
      $usedTraits = "";
      $requireList = "";

      foreach($interfaces as $interfaceName){
        if($implementedInterfaces != ""){
          $implementedInterfaces .= ", ";
        }
        $implementedInterfaces .= " $interfaceName ";
        $interface = strtolower(preg_replace("/Interface/", "", $interfaceName));
        $requireList .= "\nrequire_once(__DIR__.'/../interfaces/$interface.interface.php');";
      }

      foreach($traits as $traitName){
        if($usedTraits != ""){
          $usedTraits .=", ";
        }
        $usedTraits .= $traitName;

        $trait = strtolower(preg_replace("/Trait/", "", $traitName));
        $requireList .= "\nrequire_once(__DIR__.'/../traits/$trait.trait.php');";
      }

      if($implementedInterfaces != ""){
        $implements = " implements ";
      }

      if($usedTraits != ""){
        $uses = "use";
        $usedTraits .= ";";
      }

    $content = "<?php \n/**\n * $camelCaseClassName\n */\n$requireList\n#new-requirements-insert-point\n\n\nclass ".$camelCaseClassName.$extends.$parentClass.$implements.$implementedInterfaces."{\n$uses $usedTraits\n#new-traits-insert-point\n\n  /**\n   * $camelCaseClassName\n   */\n  $constructorVisibility function __construct(){\n    #code here..\n  }\n\n}\n\n?>
      ";

      fwrite($file, $content);
      fclose($file);

      if($realEntity){
        //adds to respond class
        makeClass("respond", "", [], [], "public");

        $respondContents = file_get_contents("$api->classes/respond.class.php");
        $respondClass = fopen("$api->classes/respond.class.php", "w");
 
        # add to requirement list
        $respondContents = preg_replace("/#new-requirements-insert-point/", "require_once(__DIR__.'/../traits/$classname"."response.trait.php');\n#new-requirements-insert-point", $respondContents);

        #use the trait
        $respondContents = preg_replace("/#new-traits-insert-point/", "use $camelCaseClassName"."ResponseTrait;\n#new-traits-insert-point", $respondContents);

        fwrite($respondClass, $respondContents);
        fclose($respondClass);

      }

      echo "Successfully created $camelCaseClassName class\n\n";
      return $camelCaseClassName;
    }
  }

  /**
   * Creates and interface given a classname
   */
  function makeInterface($interface){
    $api = $GLOBALS['api'];
    $interface = preg_replace("/[iI]nterface/", "", $interface);

    $camelCaseName = ucwords($interface);
    $interfaceName = $camelCaseName."Interface";

    $interface = strtolower($interface);

    if(file_exists("$api->interfaces/$interface.interface.php")){
      echo "$interfaceName Interface already exists\n";
      return $interfaceName;
    }

    echo "creating $interfaceName interface\n\n";

    $cmd = "touch $api->interfaces/$interface.interface.php";
    $return = false;
    $output = [];
    exec($cmd, $output, $return);
   
    if($return == 0){
      $file = fopen("$api->interfaces/$interface.interface.php", "w");
      $content = "<?php \n/**\n * $interfaceName\n */ \n\n\ninterface $interfaceName{\n\n\n}\n\n?>
      ";

      fwrite($file, $content);
      fclose($file);
      echo "Successfully created $interfaceName interface\n\n";
    }

    return $interfaceName;
  }

  function makeTrait($trait){

    $api = $GLOBALS['api'];
    $trait = preg_replace("/[tT]rait/", "", $trait);
    
    $camelCaseTraitName = ucwords($trait);
    $traitName = $camelCaseTraitName."Trait";

    $trait = strtolower($trait);

    if(file_exists("$api->traits/$trait.trait.php")){
      echo "$traitName trait already exists\n";
      return $traitName;
    }

    echo "creating $traitName trait\n\n";

    $cmd = "touch $api->traits/$trait.trait.php";
    $return = false;
    $output = [];
    exec($cmd, $output, $return);
   
    if($return == 0){
      $file = fopen("$api->traits/$trait.trait.php", "w");
      $content = "<?php \n/**\n * $traitName\n */ \n\n\ntrait $traitName{\n\n\n}\n\n?>
      ";

      fwrite($file, $content);
      fclose($file);
      echo "Successfully created $traitName trait\n\n";
    }
    return $traitName;
  }

   /**
   * Makes a logic file. 
   */

   function addMasterAndAuth($folder){
    $folder = strtolower($folder);
    $api = $GLOBALS['api'];
    echo shell_exec("mkdir $api->root\\". $folder);
    echo shell_exec("touch $api->root/".$folder."/master.inc.php");
    echo shell_exec("touch $api->root/".$folder."/auth.inc.php");
    echo shell_exec("touch $api->root/".$folder."/readme.md");

    $masterInc = fopen("$api->root/".$folder."/master.inc.php", "w");
    fwrite($masterInc, "<?php\nrequire(__DIR__.'/../master.inc.php');\n?>");
    fclose($masterInc);

    $authInc = fopen("$api->root/".$folder."/auth.inc.php", "w");
    fwrite($authInc, "<?php\nrequire(__DIR__.'/../auth.inc.php');\n?>");
    fclose($authInc);
    $readmeContents = file_get_contents($api->logicReadmeSkel);
    $readmeContents = preg_replace("/--FOLDER--/",$folder, $readmeContents);

    $readMeFile = fopen("$api->root/".$folder."/readme.md", "w");
    fwrite($readMeFile, $readmeContents);
    fclose($readMeFile);
   }

   function makeLogic($filename, $folder, $auth = true, $function = "Does what the name suggests"){
     $api = $GLOBALS['api'];
     $filename = strtolower($filename);
     echo $folder;
     echo "folder \n";
     if(!file_exists("$api->root/$folder")){
       echo shell_exec("mkdir $api->root\\$folder");
       addMasterAndAuth($folder);
     }

     if(file_exists("$api->root/$folder/$filename.php")){
        echo "$filename Logic file already exists in $folder\n";
        return;
      }

      $cmd = "touch $api->root/$folder/$filename.php";
      $return = false;
      $output = [];
      exec($cmd, $output, $return);

      if($return == 0){
        $file = fopen("$api->root/$folder/$filename.php", "w");
        $function .= ($auth) ? " and requires the session token (logged in)": " and doesn't require the session token (not logged in)";
        $auth = ($auth !== false)? "require('./auth.inc.php');":"";
        $master = "require('./master.inc.php');";
        $content = "<?php\n$master\n$auth\n\n/**\n * Description: $function \n */\n\n?>";
        fwrite($file, $content);
        fclose($file);
        echo "\n\nSuccessfully created $filename logic file in the logic folder\n\n";

        $readmeContents = file_get_contents($api->logicAppendToReadMeSkel);
        $readmeContents = preg_replace("/--FILE--/", "$filename.php", $readmeContents);
        $readmeContents = preg_replace("/--DESCRIPTION--/", $function, $readmeContents);

        $readMeFile = fopen("$api->root/".$folder."/readme.md", "a");
        fwrite($readMeFile, $readmeContents);
        fclose($readMeFile);
      }
     
   }

   /**
    * makes and include folder with .inc extension in either the owner or the hosteller
    */
   function makeInclude($filename){
    $api = $GLOBALS['api'];

    $filename = strtolower($filename);
    if(file_exists("$api->includes/$filename.inc.php")){
        echo "\n$filename Include file already exists in logic/includes folder\n\n";
        return;
      }

      $cmd = "touch $api->includes/$filename.inc.php";
      $return = false;
      $output = [];
      exec($cmd, $output, $return);

      if($return == 0){
        $file = fopen("$api->includes/$filename.inc.php", "w");
        $content = "<?php\n\n/**\n * what does this includes script do?\n */\n\n//\n\n\n?>";
        fwrite($file, $content);
        fclose($file);
        echo "\n\nSuccessfully created $filename Include file the $api->includes folder\n";
      }
   }

   function createDatabase(){
     $api = $GLOBALS['api'];
     echo shell_exec("php $api->database/migration.php");
   }

   if($argc > 1){
        $command = strtolower($argv[1]); //get the command
        if(preg_match("/^make:.+$/", $command)){
          if($argc < 3){
            echo "\nno file name specified\n";
            exit(1);
          }
          $makeFileType = preg_split("/:/", $command)[1];
          switch($makeFileType)
          {
            case "logic":
              {
                $folder = "";
                $directoryList = false;
                $isDescription = false;
                $description = [];
                $auth = true;

                for($i = 3; $i < $argc; $i++){
                  if($argv[$i] == "-d" && $folder == ""){
                    $directoryList = true;
                    $isDescription = !$directoryList;
                    continue;
                  }

                  if($argv[$i] == "-f"){
                    $isDescription = true;
                    $directoryList = !$isDescription;
                    continue;
                  }

                  if($directoryList){
                    $folder = $argv[$i];
                    $directoryList = false;
                    continue;
                  }

                  if($argv[$i] == "-na"){
                    $auth = false;
                    $isDescription = false;
                    continue;
                  }

                  if($isDescription){
                    $description[] = $argv[$i];
                    continue;
                  }


                }
                $description = join(" ", $description);
                $description = ($description == "")? "Does what the name suggests": $description;
                makeLogic($argv[2], $folder, $auth, $description);
                break;
              }
            case "class":
              {
                $interfaces = [];
                $traits = [];
                $parentClass = "";
                $isInterface = false;
                $isTrait = false;
                $isParentClass = false;
                $constructorVisibility = "public";
                $realEntity = false;
                $directoryCreated = false;

                for($i = 3; $i < $argc; $i++){
                
                  if($argv[$i] == "--md" && !$directoryCreated){
                    echo ("Createing directory named ". strtolower($argv[2]));
                    addMasterAndAuth(strtolower($argv[2]));
                    $directoryCreated = true;
                    continue;
                  }

                  if($argv[$i] == "-p"){
                    if(!empty($parentClass)){
                      echo("Only one parent class can be extended by a class");
                      continue;
                    }
                    $isParentClass = true;
                    $isInterface = $isTrait = !$isParentClass;
                    continue;
                  }
                   

                  if($isParentClass){
                    $parentClass = makeClass($argv[$i], "", [], []);
                    $isParentClass = false;
                    continue;
                  }

                  if($argv[$i] == "--private"){
                    echo "\nThe constructor for this class will be private\n";
                    $constructorVisibility = "private";
                    continue;
                  }

                  if($argv[$i] == "-i"){
                    $isInterface = true;
                    $isTrait = $isParentClass = !$isInterface;
                    continue;
                  }
            
                  if($argv[$i] == "--re"){
                    $realEntity = true;
                    #constants interface
                    $interfaceName = makeInterface($argv[2]."Constants");
                    $interfaces[] = $interfaceName;

                    #defaults interface
                    $interfaceName = makeInterface($argv[2]."Defaults");
                    $interfaces[] = $interfaceName;

                    #table interface
                    $interfaceName = makeInterface($argv[2]."Table");
                    $interfaces[] = $interfaceName;

                    #response trait
                    $traitName = makeTrait($argv[2]."Response");
                    #adds to the response class
                    continue;
                  }

                  if($argv[$i] == "-t"){
                    $isTrait = true;
                    $isInterface = $isParentClass = !$isTrait;
                    continue;
                  }

               

                  if($isInterface){
                    $class = preg_replace("/[Ii]nterface/", "", $argv[$i]);
                    $interfaceName = makeInterface($class);
                    $interfaces[] = $interfaceName;
                  }

                 
                  if($isTrait){
                    $class = preg_replace("/[tT]rait/", "", $argv[$i]);
                    $traitName = makeTrait($class);
                    $traits[] = $traitName;
                  }
                  
                }

                makeClass($argv[2], $parentClass, $interfaces, $traits, $constructorVisibility, $realEntity);
                break;
              }
            case "include":
              {
                makeInclude($argv[2]);
                break;
              }
            case "trait":
              {
                $traitName = makeTrait($argv[2]);
                
                if($traitName === false)break;
                $trait = strtolower(preg_replace("/[tT]rait/", "", $traitName));
                $requirement = "$trait.trait.php";

                $addToClass = false;
                for($i = 3; $i < $argc; $i++){

                  if($argv[$i] == "-a"){
                    $addToClass = true;
                    continue;
                  }

                  if(!$addToClass) continue;

                  $className = strtolower($argv[$i]. ".class.php");

                  if(!file_exists("$api->classes/$className")){
                    echo "$className doesn't exist";
                    continue;
                  }

                  $classContents = file_get_contents("$api->classes/$className");
                
          
                  # add to requirement list
                  $classContents = preg_replace("/#new-requirements-insert-point/", "require_once(__DIR__.'/../traits/$requirement');\n#new-requirements-insert-point", $classContents);

                  #use the trait
                  $classContents = preg_replace("/#new-traits-insert-point/", "use $traitName;\n#new-traits-insert-point", $classContents);

                  $currentClass = fopen("$api->classes/$className", "w");
                  fwrite($currentClass, $classContents);
                  fclose($currentClass);

                }

                break;
              }
            case "interface":
              {
                makeInterface($argv[2]);
                break;
              }
            default:
            {
              help();
            }
          }
        }
        else switch($command){
          case "--migrate":
            {
              createDatabase();
              break;
            }
          default:
          {
            help();
          }
        }

   }else{
     echo "\ntype -help to see the list of commands\n";
   }

   function help(){
    $haliConfig = $GLOBALS['haliConfig'];
    echo file_get_contents($haliConfig->commandsDoc);
    return;
   }

?>