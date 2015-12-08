# pc_to_sd_card
This code is meant for copying the contents from Linux system to SD Card     
Installation Process                                                                
Open linux terminal and type sudo visudo                                            
Type the password and get logged in as root                                         
Goto the last line of the file and paste following content                          
"ALL ALL=NOPASSWD: /var/www/bftp/root.sh"                                           
This line allows the apache webserver to run the shell script with root permission.
and no password is allowed.

