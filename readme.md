# Laravel Restful Api with JWT
## description
&#160; &#160; &#160; &#160;Use the laravel framework and JWT and dinjo/api to bulid a restful api which include login and register
 
## required
* composer  
* php(version>=5.6.4)  
* mysql  

## install and config
* run `composer install`
* config the **.env** config your own mysql info  
![](file:///Users/denverb/Desktop/%E5%B1%8F%E5%B9%95%E5%BF%AB%E7%85%A7%202017-08-22%20%E4%B8%8B%E5%8D%883.53.17.png)  
* run `php artisan migrate` to bulid database  
* run `php artisan db:seed` to Generate test data  
* run `php artisan serve` to start it  

## Usage
1. Register:   
url: hostname/api/register/  
method: post  
param: email,name,password  
response: json(token,message,status_code)  
2. Login  
url: hostname/api/login/  
method: post  
param: email,password
response: json(token,message,status_code)  
3. restfulApi  
url: hostname/api/user/
method: get,post,put,delete  
4. change code to meet your own needs  
controller: App\Http\Api\  
route: routes\api.php