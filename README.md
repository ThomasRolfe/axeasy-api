# Axeasy.io

# Axeasy is a web app that helps Axie Infinity scholarship managers keep track of users, assets and scholarship profitability.

![image](https://user-images.githubusercontent.com/20173930/134164197-76c0a0d2-1d8c-4773-8e48-56ee518bb7e4.png)


The API makes use of Laravel sanctum for authentication. Calls should be made to the xsrf-cookie endpoint which provides a cookie to authenticate further calls.

All actions beyond register/login/cookie require a logged in user


|Description|Path|Method|Parameters|
|---|---|---|---|
|Get XSRF cookie|/api/xsrf-cookie|GET|
|Register as a new user|/register|POST|name, email, password, password_confirmation|
|Log in as user|/login|POST|email, password|
|Get authed user details|/api/user|GET||
|Get index of scholarships for authed user|/api/scholarships|GET||
|Get single scholarship by ID|/api/scholarships/{scholarshipId}|GET||
|Create new scholarship|/api/scholarships|POST|label, start_date|
|Create new company|/api/companies|POST|label|
