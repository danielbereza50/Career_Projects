
  Libraries / Snippets Used

  Name: 

  Version: 

  Purpose: 

  License: MIT

  Website: https://github.com/
  




  Future Features:
  
  1. 




-----------------------


How to properly include plugin files:

include __DIR__.'/functions.php';


echo plugin_dir_url( __FILE__ ) . 'images/'; 


How to 'hack' a plugin

1. Change the plugin version number to 999.999.999 in the plugin header 
2. Create a backup of every file that was touched with an extrension of .bk in the same directory
