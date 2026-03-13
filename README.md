## Run project


1. composer install
2. composer run dev
3. php artisan migrate --seed
4. php artisan reverb:start  
5. Redis should be running

### Test users

```
'email' => 'admin@example.com'
'password' => '123456'

'email' => 'user@example.com',
'password' =>'123456',
```