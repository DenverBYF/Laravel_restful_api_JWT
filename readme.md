# Laravel Restful Api with JWT
## description
&#160; &#160; &#160; &#160;Use the laravel framework and JWT and dinjo/api to bulid a restful api which include login and register
 
## required
* composer  
* php(version>=5.6.4)  
* mysql  

## install and config
* run `composer install`  
* run `cp .env.example .env`  
* run `php artisan key:generate`
* config the **.env** config your own mysql info  
![](https://github.com/DenverBYF/Laravel_restful_api_JWT/raw/master/Screenshots/1.png)  
* add dingo\api info into .env  
`API_STANDARDS_TREE=vnd  
API_SUBTYPE=myapp  
API_PREFIX=api  
API_VERSION=v1  
API_DEFAULT_FORMAT=json  
API_DEBUG=true`  
* run `php artisan vendor:publish --provider="Dingo\Api\Provider\LaravelServiceProvider"`  
* run `php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"`  
* run `php artisan jwt:secret`
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
3. restfulApi(use these api should add the token in header first)  
![](https://github.com/DenverBYF/Laravel_restful_api_JWT/raw/master/Screenshots/2.png)  
url: hostname/api/user/  
method: get,post,put,delete  
4. change code to meet your own needs  
controller: App\Http\Api\  
route: routes\api.php