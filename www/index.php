<?php
/**

__________       __                                  _________                __                
\______   \____ |  | __ ____   _____   ____   ____   \_   ___ \  ____   _____/  |_  ___________ 
 |     ___/  _ \|  |/ // __ \ /     \ /  _ \ /    \  /    \  \/_/ __ \ /    \   __\/ __ \_  __ \
 |    |  (  <_> )    <\  ___/|  Y Y  (  <_> )   |  \ \     \___\  ___/|   |  \  | \  ___/|  | \/
 |____|   \____/|__|_ \\___  >__|_|  /\____/|___|  /  \______  /\___  >___|  /__|  \___  >__|   
                     \/    \/      \/            \/          \/     \/     \/          \/       

Welcome to Pokemon Center(pmc).

Q1: What is Pokemon Center?
A1: 1. You can Leave a message
    2. Upload your Pokemon (your picture)
    3. Show PokeDex (pokemon list) from Database
    4. URL: .../module/function/argv/ ,it's easy to use!

Q2: What will "Service Check" do?
A2: 1. Check / Search the pokemon list (EX: .../db/id/..../ or .../db/name/..../ )
    2. Check the flag's hash value under the pages (flag after md5 hash)
    3. Upload an image and check the picture
    4. Leave / check message (EX: .../message/search/.../ )
    6. We use URL to access the website
      (EX: .../db/id/1/ to check the pokemon , so you can't change the module/function name)

Q3: How we change the flag?
A3: our server use ssh to login MySQL (with user: root) and update the flag / pokemon list (24 rounds)

Q4: Can I disable/edit function?
A4: Service check is in Q2. Please make sure that the service is still works.

Q5: ** some important hint **
A5: 1. If attacker get ssp's shell (or backdoor), maybe he can get pmc's flag.
    2. If you can't get other team's pmc flag. Disable other team's pmc service is also a good choice.
       (EX: Some people patched the SQL injection.
            but you can use "XSS" to redirect his message board [so that service check will fail.]
            use fork bomb/Dos is not allowed!)
    3. set the File Permissions right (if you found that you can't leave message or upload image)
       (for example : upload image should set "pc" folder permission to  777)


__________            .__               
\______   \ _______  _|__| ______  _  __
 |       _// __ \  \/ /  |/ __ \ \/ \/ /
 |    |   \  ___/\   /|  \  ___/\     / 
 |____|_  /\___  >\_/ |__|\___  >\/\_/  
        \/     \/             \/        


What we learned from Project 2 ?

.CTF (Catch the Flag)
=> (Web) What is Cookie?
=> (XSS) **What is XSS?**
=> (XSS/PHP) ***Simple javascript + PHP Programing***
=> (SQL) **What is SQL Injection?**
=> (Web) *urlencode*
=> (Web) User-Agent
=> (Web) robots.txt


.Report
=> (SQL) ***How to defend SQL Injection?***
=> (XSS) ***How to defend XSS?***

.What else will be useful in this Final Project?
=> (SQL) How to filter SQL Statement?
=> (XSS) How to Print strings without XSS vulnerabilities?
=> (PHP) How to call function in this pmc system?
=> (PHP) How to restrict upload files?
=> (PHP) Customize your own logger. tcpdump is hard to use

**/

header("Location: ./menu.php");
die();

?>
