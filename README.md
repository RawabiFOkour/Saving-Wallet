# Saving-Wallet

 # To run this project :- 
   1. clone project
   2. run command : composer install
   3. create .env file
   4. run command : php artisan key:generate
   5. run command : php artisan migrate:fresh --seed
   6. run command : php artisan serve

# After run this command (php artisan migrate:fresh --seed) is attached above, you can use seeder data to login (User or admin).
# user =>
                email => user@gmail.com
                password => 12345678
                
          _____________________________________
            
# admin =>  
                email => admin@gmail.com
                password=> 12341234
                
          ______________________________________
