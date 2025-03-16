## Installation

```shell
php artisan migrate
php artisan db:seed
php artisan storage:link
```

## Endpoints
Based on pet endpoints https://petstore.swagger.io/#/pet

| Method       | uri            | type    |
|--------------|----------------|---------|
| GET \| HEAD  | api/pets       | index   |
| POST         | api/pets       | store   |
| GET \| HEAD  | api/pets/{pet} | show    |
| PUT \| PATCH | api/pets/{pet} | update  |
| DELETE       | api/pets/{pet} | destroy |