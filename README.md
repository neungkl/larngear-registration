# Larngear Registration

16th Larngear Registration Website

<img src="preview.png" width="550">

## Features

- An easily public registration system for end-user
- Auto-generate ID code group by province and gender
- Auto-generate envelope cover using GD image library

## Installation

1. Set up `.env` variable. Change `.env.sample` to `.env`
2. `npm install && gulp`
3. `php composer.phar install`
4. Import database from `backup/Larngearregister.sql`
5. Don't forget to initialize table `Larngearregister.counter` (Add default type with zero counting number)
6. Done

PS. you can also deploy via Heroku (`Procfile` available)

## License

[GNU GENERAL PUBLIC LICENSE 3.0 &copy; Kosate Limpongsa](LICENSE.md)
