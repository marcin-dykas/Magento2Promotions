# Promotions - Module adds two tables to database and three REST methods to work with data

### Added Table - mdykas_promotions_group
### Added Table - mdykas_promotions_promotion

## Instalation:

1. Copy module folder to ./app/code directory
2. Run bin/magento module:enable MarcinDykas_Promotions
3. Run bin/magento setup:upgrade && bin/magento setup:di:compile
4. Sample data is added for testing/playing purposes
5. Create admin account using 2FA
5. Execute example endpoint CLI requests changing your credentials and domain accordingly 

## Unit tests
### Groups
./vendor/bin/phpunit -c dev/tests/unit/phpunit.xml.dist app/code/MarcinDykas/Promotions/Test/Unit/Model/GroupRepositoryTest.php
PHPUnit 9.6.21 by Sebastian Bergmann and contributors.

......                                                                                                                                                                         6 / 6 (100%)

Time: 00:00.036, Memory: 12.00 MB

OK (6 tests, 19 assertions)

### Promotions
./vendor/bin/phpunit -c dev/tests/unit/phpunit.xml.dist app/code/MarcinDykas/Promotions/Test/Unit/Model/PromotionRepositoryTest.php
PHPUnit 9.6.21 by Sebastian Bergmann and contributors.

......                                                                                                                                                                         6 / 6 (100%)

Time: 00:00.042, Memory: 12.00 MB

OK (6 tests, 19 assertions)

## Magento2 coding standards met
./vendor/bin/phpcs --standard=Magento2 app/code/MarcinDykas/Promotions

## Example Endpoints usage:

### Access token request
curl -k -XPOST -H 'Content-Type: application/json' https://magento.test/rest/V1/tfa/provider/google/authenticate -d '{ "username": "mdykas3", "password": "bebz", "otp": "268922" }'

### Access token response
eyJraWQiOiIxIiwiYWxnIjoiSFMyNTYifQ.eyJ1aWQiOjIsInV0eXBpZCI6MiwiaWF0IjoxNzMxNjc4Nzk3LCJleHAiOjE3MzE2ODIzOTd9.dgm64Yo7j4XjEG3FoDkMJycD6P6DPlPasVrHDnrAPLg

### GET Group By ID request
curl --location --request GET 'https://magento.test/rest/V1/groups/1' --header 'Accept: /' --header 'Connection: keep-alive' --header 'Authorization: Bearer eyJraWQiOiIxIiwiYWxnIjoiSFMyNTYifQ.eyJ1aWQiOjIsInV0eXBpZCI6MiwiaWF0IjoxNzMxNjc4Nzk3LCJleHAiOjE3MzE2ODIzOTd9.dgm64Yo7j4XjEG3FoDkMJycD6P6DPlPasVrHDnrAPLg'

### GET Group By ID response
{"group_id":1,"name":"Black Friday","created_at":"2024-11-15 12:24:16","updated_at":"2024-11-15 12:24:16"}

### GET Promotion By ID request
curl --location --request GET 'https://magento.test/rest/V1/promotions/2' --header 'Accept: /' --header 'Connection: keep-alive' --header 'Authorization: Bearer eyJraWQiOiIxIiwiYWxnIjoiSFMyNTYifQ.eyJ1aWQiOjIsInV0eXBpZCI6MiwiaWF0IjoxNzMxNjc4Nzk3LCJleHAiOjE3MzE2ODIzOTd9.dgm64Yo7j4XjEG3FoDkMJycD6P6DPlPasVrHDnrAPLg'

### GET Promotion By ID response
{"promotion_id":2,"group_id":2,"name":"Gray Monday","created_at":"2024-11-15 12:30:31","updated_at":"2024-11-15 12:30:31"}

### POST Adding Group
curl -k -XPOST -H 'Content-Type: application/json' https://magento.test/rest/V1/groups --header 'Accept: /' --header 'Connection: keep-alive' --header 'Authorization: Bearer eyJraWQiOiIxIiwiYWxnIjoiSFMyNTYifQ.eyJ1aWQiOjIsInV0eXBpZCI6MiwiaWF0IjoxNzMxNjc4Nzk3LCJleHAiOjE3MzE2ODIzOTd9.dgm64Yo7j4XjEG3FoDkMJycD6P6DPlPasVrHDnrAPLg' -d '{"group": {"name": "Green Thursday"}}'

### GET Getting list of Groups using search criteria request
curl -g -X  GET "https://magento.test/rest/V1/groups?searchCriteria[filter_groups][0][filters][0][field]=created_at&searchCriteria[filter_groups][0][filters][0][value]=2000-01-01+00:00:00&searchCriteria[filter_groups][0][filters][0][condition_type]=gt&searchCriteria[pageSize]=15&searchCriteria[currentPage]=1&fields=name" -H "accept: application/json" -H "Authorization: Bearer eyJraWQiOiIxIiwiYWxnIjoiSFMyNTYifQ.eyJ1aWQiOjIsInV0eXBpZCI6MiwiaWF0IjoxNzMxNzUwODgxLCJleHAiOjE3MzE3NTQ0ODF9.OCbGFXJ6r98rjRAWR1WpUeDU6pbuj0N-7ZCV0pkYohc"

### GET Getting list of Groups using search criteria response
[{"name":"Black Friday"},{"name":"Black Week"},{"name":"Black Month"},{"name":"Green Thursday"}]

### GET Getting list of Promotions using search criteria request
curl -g -X  GET "https://magento.test/rest/V1/promotions?searchCriteria[pageSize]=15&searchCriteria[currentPage]=1&fields=name" -H "accept: application/json" -H "Authorization: Bearer eyJraWQiOiIxIiwiYWxnIjoiSFMyNTYifQ.eyJ1aWQiOjIsInV0eXBpZCI6MiwiaWF0IjoxNzMxNzgwMDQ5LCJleHAiOjE3MzE3ODM2NDl9.VAixQI_jcCVCS-6h2767YafIxzYthvKc4rU2hzNkYD8"

### GET Getting list of Promotions using search criteria request
[{"name":"Yellow Wednesday"},{"name":"Gray Monday"},{"name":"Yellow Wednesday"}]

### DELETE Removing Group By ID request
curl --location --request DELETE 'https://magento.test/rest/V1/groups/1' --header 'Accept: /' --header 'Connection: keep-alive' --header 'Authorization: Bearer eyJraWQiOiIxIiwiYWxnIjoiSFMyNTYifQ.eyJ1aWQiOjIsInV0eXBpZCI6MiwiaWF0IjoxNzMxNzgwMDQ5LCJleHAiOjE3MzE3ODM2NDl9.VAixQI_jcCVCS-6h2767YafIxzYthvKc4rU2hzNkYD8'

### DELETE Removing Promotion By ID request
curl --location --request DELETE 'https://magento.test/rest/V1/promotions/2' --header 'Accept: /' --header 'Connection: keep-alive' --header 'Authorization: Bearer eyJraWQiOiIxIiwiYWxnIjoiSFMyNTYifQ.eyJ1aWQiOjIsInV0eXBpZCI6MiwiaWF0IjoxNzMxNzgwMDQ5LCJleHAiOjE3MzE3ODM2NDl9.VAixQI_jcCVCS-6h2767YafIxzYthvKc4rU2hzNkYD8'



