# POS

POS is a point of sale system for restaurants aimed at working with small devices (like smartphones) and optionally printers.

## Getting Started (as of 1/16/2021)

The application is still in works and does not include all of the functionalities I want it to, but depending on needs, it could be enough for certain restaurants to work with. Also, this is the first 'stable' version which is just a slightly edited copy of master. *I would not consider it stable*, so you might encounter problems, *for the most part* it should be fully functional. (future stables will actually be stable)

There are still a lot of UI/UX improvements to make, as well as adding some functionalities to deal with more cases more efficiently (for example, choosing a bundle, and then choosing items separately, like what you may see ordering at McDonalds or KFC, as well as the whole app being more JS reliant, so it does not stop working if you lose wi-fi for a second, ending on a possible entire rewrite and redesign). Still, for the most part, the whole 'foodchain' from beginning to end is implemented and functional.

### Installing

To install the application you will only need a PHP server with MySQL support, like xampp. All you need to do is allow mod_rewrite and put the project on your server. Then, you can access it by simply going to it's URL, by default:

```
http://localhost/pos/
```
If you have a different path to the POS, you should change the base url in pos/application/config/config.php.

So far there is no built in CMS, so you need to manage everything from your database. You will need to set up a database for users and items, register an account and give it access of 1 or higher. Then you can log in using that account and play around with the POS.

In this case ('stable' version, which is not exactly the case, more in Getting Started), there is .sql and .xml database file provided, so you can set these up instead to go (hopefully) straight to testing.

### Usage

Developement mode is on, so if you go into waiter's menu (Kelnerzy) and you type in the same username as password, or just go to kitchen menu (Kuchnia), you will be logged in as admin and get access to both waiter's menu and kitchen. There is no logout button currently (as there was no need for such), but for testing purposes, there is a logout() javascript function if you ever need to log out.

Something to keep in mind right now, is that Kitchen menu is meant to be displayed on a larger screen (tablet or even a laptop), while waiter's menu is meant for small screens, mostly phones.

Other than that, usage is pretty simple. 
Waiter chooses a table and adds a new order for that table. Then, he adds orders to the table (there is a to-go option, as well as possible comment for each item to handle edge cases and surprises). 
When waiter is done with taking in the order, he can confirm it, and everything that is meant to be handled by kitchen (so all the food, but not drinks for example), which currently is set up to PIZZA ONLY MODE (so only pizza's appear in Kitchen menu, which eventually will be the case for Pizza menu which right now is just a redirect to Kitchen menu) will appear in the kitchen view. 
Now, when the kitchcen prepares a dish, they can confirm it's ready, and the dish (and the whole order) will become yellow for the waiters as an information that they should take out the dish.
When the waiter comes to pick up the this, he or the cooks can confirm which dishes are taken, which gives those dishes a status of delivered, which is displayed as light green currently.
Similarly, waiter only items like drinks, get a button to confirm delivery in the waiter menu instead and also go green.

Finally, when the order is fully taken care of, the waiter has an option generate cash register friendly output (so exactly what he has to type on the cash register to take care of this order), and when the order is paid for, he can close it and it will get hidden.

## Built With

* [CodeIgniter](https://codeigniter.com/) - The web framework used

## License

This project is licensed under the MIT License - see the [license.txt](license.txt) file for details

## Acknowledgments

Huge thanks to [PurpleBooth](https://gist.github.com/PurpleBooth/109311bb0361f32d87a2) for this README template.

## Contributors

Huge thanks to [Pjacyn](https://github.com/Pjacyn) for help he is best brother ever.
