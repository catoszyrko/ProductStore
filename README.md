## ProductStore

Languages and Tech:
- PHP & MySQL for backend
- Javascript, HTML, CSS (Bootstrap) for Front

## First Setup the database 

```
    define('DB_SERVER','');
    define('DB_USER','');
    define('DB_PASSWORD','');
    define('DB_NAME','');
```

Next step is running the .sql file in your localstore or online server


##  API
To use API, just go to api/index.php 

Use postman for testing. Allways with post method
READ EXAMPLE
```
{
    'action': 'read'
}
```



action: read


FIND EXAMPLE
```
{
    'action': 'find',
    'id': '8'
}
```

ADD / CREATE EXAMPLE
```
{
    'action': 'add',
    'nombre': 'televisor',
    'marca': 'philips',
    'sku': '12345678',
    'costo: '1000',
    'detail_1': 'LCD',
    'detail_2': '60'
}
```