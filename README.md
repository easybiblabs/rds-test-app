# RDS Test App
This is a small PHP script that will measure the time it takes for the round-trip of opening and
closing a database connection.

The configuration is read from our `.deploy-configuration.sh`. The used variables are:
- RDS_TEST_HOST
- RDS_TEST_PORT
- RDS_TEST_DBNAME
- RDS_TEST_USERNAME
- RDS_TEST_PASSWORD
