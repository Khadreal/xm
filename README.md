<p align="center">XM.com PHP Test</p>



## About Test

Created a frontend to search for historical financial data using rapidapi.

## To run this, please follow the instructions below;

- Run update composer or sail up(if you're using docker)
- Run `migration` and `db:seed` to create the company data.
- Add your api key - `YH_API_KEY` to your environment variable.
- Add `YH_ENDPOINT=https://yh-finance.p.rapidapi.com/stock/v3/get-historical-data` to your environment, for the endpoint
- Run `artisan test ` to see test results
- Add mailtrap credential to test the email, the email is sent via queue system, you'll need to run `artisan queue:table`, 
`artisan migrate` and `artisan queue:work` 
- Lastlt, update the queue connection in environment variable to database

## TODO:
- Couldn't complete the plotting of graph
