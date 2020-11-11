# CatsEG
A web based application integrating an educational platform with different games made using UNITY.


## Installation

1. Open Unity Source Code Folder
2. Go to files --> Build Settings (Make sure under Platform, WebGl is ticked AND Make sure all scenes are ticked) --> Do not click development build under WebGL --> Once that is done click build
3. Paste the Game into Game Executable folder and make sure it is named as Who_Lost_Roger
2. Update your local database with the DBsql file in DBsql file
3. Set read write permission on your folders for image upload function to work
4. Notes
    a. Under Assets --> WebGlTemplates->FixedRatioScale->Index.php

        - On line 1 change it to Access-Control-Allow-Origin: * if url is unkown

    b. Under Assests --> Scripts --> LoadingData.cs and SendingData.cs
     
        - On line 17 change URL link to your own link for loadData.php and saveData.php

    b. Update the db fields on platform/includes dbconfig.php and unity source code/assests/webgltemplates/fixedratioscale/connectdb.php with your own database name
    
        - CatsEg Db host: localhost

        - CatsEg Db username: catseg

        - CatsEg Db password: catsegdeco3801

        - CatsEg Db name: catseg

## Contributors
- [Yu Kai Ku](@yukaiku)
- [Dawen Wang](@Darwen)
- [Ruihan Chin](@RaeCrh)
- [Theodore Theo](@Tehteddae)
- [Yan Su](@Kohakusona)


## Libraries Used
- [Bootstrap](https://getbootstrap.com/)
- [Chart Js](https://www.chartjs.org/)
- [Jquery](https://jquery.com/)
