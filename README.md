
# Laravel Weather API
Laravel Weather API is the project which provides api for acccessing weather based on latitude and longitude. I have used [openweathermap](https://openweathermap.org/api) api to fetch the current weather information.

## Installation

### Requirements
* PHP 8
* mySQL 
* API key of [openweathermap](https://openweathermap.org/price)

### Laravel Passport for Authentication
I have used laravel/passport for the authentication , we need oauth client id and secret. So we need to enter the following command
```
$ php artisan passport:install
```
#### Note: Use the second client id and secret.

### Generate Demo user
* One demo user will be generated with following details:
##### User 1:
* Phone: demouser@email.com
* Password: Password1
```
$ php artisan db:seed --class=UserTableSeeder
```

### API Docs 
##### [Postman doc link](https://documenter.getpostman.com/view/7421850/2s9XxvTF9r)

### Register:
#### Method
POST
#### Path
#### `/api/register`
#### Body
* name: Name of the user. Required.
* email: Email of the user. Required.
* password: Password must be minimum 8 character and required.
* password_confirmation: Password Confirmation must be same as password and required.
#### Return
```json
    {
        "data": {
            "id": 63,
            "name": "Test user",
            "email": "test@email.com",
            "email_verified": false,
            "created_at": "2023-08-02 08:52:52",
            "updated_at": "2023-08-02 08:52:52"
        }
    }
```

### Login:
#### Method
POST
#### Path
#### `/api/login`
#### Body
* grant_type: `password`
* client_id: Laravel Passport oauth client id 
* client_id: Laravel Passport oauth client secret 
* username: Email of the user
* password: Password of the user
#### Return
```json
        {
            "token_type": "Bearer",
            "expires_in": 31622400,
            "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIyIiwianRpIjoiNzVmZWE0MjdlMGZkODE2N2UzMjVlZGNiM2E0NWVmMWIzNGIxMWNhYzMzNTZlMzg0M2FmNmEwMDZkMjM2NjdjYjZlMjVlYWE0MjNiZTM1NDkiLCJpYXQiOjE2OTA5MTAzOTIuMDkwMTc1LCJuYmYiOjE2OTA5MTAzOTIuMDkwMTc3LCJleHAiOjE3MjI1MzI3OTIuMDgxOTAzLCJzdWIiOiIyNCIsInNjb3BlcyI6WyIqIl19.PJGU97G2Hv32V23oW_Ij8OBn9xUSIWiUel_7u7_v12KhM9NAHZPYNMrmClGBGwrrQtXc62yEDrGVH6zbqQcZyk8HBOwBvRW6cAd4EQkVwq54diNyPoh8x9_ipod1HKk2Joixy6vpPkoAWhom5p5p-xmvYne2s_sSmvEyHN0O4lpPeMHxO1v_lNa1tvVwniMp735v-6z1NzkYzytS7PdzdpEaHkiZde47lxMS2lYB6hW55Tz4NEaHIAxUGE20ADGzOM7HIeo2_dO_gAX8NzDdqn-MUNfIKcPqUB5JrIpZ8Qew-wfkf3cftQpY0rvDGfbfxA1MQrd7OlFyMwbK5wfTJMQqoJgBcLEBVHICJuo94ykUiGMmldLw_2rOrcoix1cdK1oRTN1ZAB5AeZrvz1nvtJOYpH4zt4I30wflAUnf7hSB0W0dnGgwP_QK0eQqFDInWa101W10HjQ8OYoAyOSe9g-ZOrPqXCIKdsTYQi6MNEzyvfT1eWUHMnUSFRSoeFGJVaSYgeTgTlk7NFnlSp-0kEe8fM3m-ZeZVEvMde5KQ0TK-Gw8igxl31A8eO4jbV936heeWUlTeT_eSw-klkA8cDDMhGCjbsLuSKW1I5RzWPgcTLLbb1Xq2ByYvAorUSvZ753jxp_ZBuc_10eW_4DkFFZtpqJNKZkdympqE7UKKrU",
            "refresh_token": "def502004dd64f2e54972ff2282ff25163e382fdc367ad8bf0aafe1cc689fa84b3e435a494e5e42fe38efedcb573d840e610a414a72a1009cd6700fd66f68cdab5cd830ee051b26dfc7e3d19f90a1d92b55c17cbdc6df21e4440ffaf8ba03c497b96c0886c0cea9136c5bdae46b1b690557ec1b937ea0be2372de727e859aab94829f4a82a5069e010004bbf14d2ee98f0baf3a311fc8696821b239a2ea77965d2ad0d2e25287b32f389f7767141fbab4eda3b8e215c0029c26fca2ff3b7e56c114419f30fa4132cc93a248d574a48c53b22c66fb8ee2ab25a3b8608b8dc7b5bac6f5d675ca85d215b99222026b5943b7e9bbf4c7eec0a67a86b3069698e33337e72824eed41b75716c128f2456ee22a0484649d97ad2cd84bf849f57f3c002a4ebd147a440ec544c57a76ace81caacf15fce2803990e520f66fc5c4cdb903a83f6f5ccc4f5c94cc626c7be8aa2808a2928343bf45fcef110df4a39b6088d91b6a4a854f50"
        }
``` 

### Logout:
#### Method
DELETE
#### Path
#### `/api/logout`
#### Return
```json
        {
            "status": 200,
            "message": "The user has logged out successfully."
        }
``` 

### Weather:
#### Method
GET
#### Path
#### `/api/weather?lat=27.712&lon=85.313`
#### Params
* lat: Latitude of the location
* lon: Longitude of the location  
#### Return
```json
            {
                "timezone": 20700,
                "id": 1282682,
                "name": "Thapathali",
                "cod": 200,
                "dt": "08/02/2023 09:26 AM",
                "coord": {
                    "lon": 85.313,
                    "lat": 27.712
                },
                "weather": [
                    {
                        "id": 803,
                        "main": "Clouds",
                        "description": "broken clouds",
                        "icon": "04d"
                    }
                ],
                "base": "stations",
                "visibility": 8000,
                "wind": {
                    "speed": 5.14,
                    "deg": 280
                },
                "clouds": {
                    "all": 75
                },
                "sys": {
                    "type": 2,
                    "id": 2080684,
                    "country": "NP",
                    "sunrise": "08/01/2023 11:41 PM",
                    "sunset": "08/02/2023 01:08 PM"
                }
            }
``` 

### Get All Users List:
#### Method
GET
#### Path
#### `/api/users`
 
### Get User By Id:
#### Method
GET
#### Path
#### `/api/users/{id}`

### Get Currenly logged in User:
#### Method
GET
#### Path
#### `/api/users/current`

### Testing:
#### Auth:
##### Login
* A user can login with username and password   
* A user can not login with wrong client id  
* A can not login with wrong password
```
File Path: tests/Feature/Auth/LoginTest
```
##### Logout
* A user can logout
```
File Path: tests/Feature/Auth/LogoutTest
```
#### Weather:
* Weather data returns in valid format   
* If lat is not provided
* A user can logout
```
File Path: tests/Feature/WeatherTest
```

#### User:
* Can get user list
* Can get user by id
* Can get current user  
```
File Path: tests/Feature/UserTest
```