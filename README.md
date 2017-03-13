#ShareMyTrip
_"Keeping the *Let's Go* and taking the *Uh-Oh* out of travel"_

Made by [Lionel EGGER](mailto:lionelegger@gmail.com)

##What is 'Share My Trip'?
'ShareMyTrip' is a website that helps travellers to plan, map and budget a trip. When you travel alone, everything is easy... But what happens when you travel with friends, share bills? Sometimes you pay for all your friends, organize excursion only with a subgroup of friends or buy yourself a souvenir... It can very quickly be a complex task to calculate the trip expenses. ShareMyTrip makes travelling together easy and facilitate all expenses calculation. It helps you to plan, manage and visualize your future trips. 

##How to use the website
When you arrive to the homepage, the first thing you need to do is to login or register as a new user. The password is encrypted. If you register, you are automatically logged in. 
Once you are logged in, you arrive on the trip page. Once logged, you can always change your personal information by clicking on your avatar 

###Profile page
This page allows you to modify your personal information, as well as to change your avatar picture or even upload another one (300px by 300px). The changes will be visible only after logout and login again. 

###Trip page
This page is the first one a new user sees when he logs in. A welcome message indicate the 3 main steps he should do: "Add a trip", "Add users" and "Add actions". In the beginning, only the "Add a trip" option is available. 
* **Add trip**: This will add a new trip. The currency defines which currency will be used for the current trip. If you plan to manage most of your expenses in the foreign currency, then define it here. NB: The currency functionality is saved but yet no currency rate has been implemented yet. The dates are not mandatory if they are not known yet. You can always change the trip setting by clicking on the "settings" button on the top right corner of the trip box. 
* **Add user**: You can choose to travel alone or with friends. If you travel with friends, click on "Add a user", otherwise, you can directly "Plan this trip". If you want to share a trip with someone else, this latter should have an user registered in the system. You add a new user to a trip using his email adress.

###Plan page
The plan page gives you an overview of all trip actions organised by date. You can also easily see which action is not paid, partially paid or full paid thanks to the action color codes. Each action is represented by a point when the action is described by a single time or spacial entry or two points when an ending time or location has been defined. Each action is editable by just cliking on the icon. When an action extends to the next day, the ending date appears on the right side of the line.  

###Add/Edit an action page
'Add an action' button is visible on 'Plan', 'Map' and 'Budget' pages in order to quickly access to this page that will be widely used. 'Edit an action' is reached anytime you click on the action icon, from any page too.
* Actions are classified in **4 categories**: Travel, Lodging, Activity and Other. Each category have a certain amount of actions **types**. When you choose the Lodging category, you logically don't have an ending location. This fields are mandatory. 
* All other actions can be described with a **starting and ending time and location** but these fields are not mandatory. If the ending date is not filled, it presupposed that it's the same date as the starting date. 
* The **name** of the action is mandatory. It describes the action. 
* The 'Company', 'Reservation', 'Identifier' and 'Notes' fields are not mandatory and can be useful to detail an action. For example, the flights or hotel details are typically entered here.
* **Share**: This field specifies with whom you will share the specific action. By default, you share an action with all participant of the trip. But you can restrict the action scope to only some users, or even only you. For example, If you travel with another couple, one couple could have a superior room which means a higher cost. It would also be used when a participant of the trip joins you for only a part of the trip. The flights can be also registered separately if participants of a trip all meets in a city and then travel together. For a personal expense, you can select the 'only me' button.
* **Expenses**: The expenses box is separated in two sections: 
    + **Price**: Define here the total price of the action. It means that it does not represent the individual price, but it encompass the global price for all participants. The price is not mandatory as we can plan an action without knowing the price in advance or even register free actions. 
    + **Payments**: The totality of an action price is not necessarily paid in one go. For example, you might have to pay a first installment before the trip and what's left must be paid on site. You can register all payments here and the sum will be automatically calculated, as well as what's left to pay. The status of the global payment is updated at each payment registration and the sum will be in the currency defined in the trip settings. 

###Map page
The map page shows on a common map all actions that have been geolocalised. 

###Budget page
The budget page summarise all expenses made by all trip participants. The total price of the action on the right is the price defined in the "add/edit action" page. At the bottom of the page, in the "TOTAL paid" row, we get the totality paid for each participant. Below, we get the "TOTAL trip" row that is the totality that has to pay each participant. It calculates the sum of all actions of the trip for each user. And finally, the last row "Still to pay" is the balance between the amount paid and to be paid... These values are dependent of the user since each user does not necessary takes part in each action.   



##Website Architecture
ShareMyTrip website is based on **Model-View-Controller** (MVC) software design pattern. 
* The Database is a **MySql database** managed by **[cakePHP](https://cakephp.org/)**, a php framework. . 
* The controller is managed with **cakePHP** too. This latter provides JSON feeds to the views. 
* The views are html5/css3 with a layer of angularJS. AngularJS send JSON requests to the controller and updates the view in consequence. 

###Model
The Database contains 9 tables (illustrated in this [pdf](/files/ShareMyTrip-DB.pdf)) organised around 3 main tables: 
1. **users**: This table is the core of the DB. In order to use the website, you need first to login or create a user account. This latter has an *email*, *first name* and *last name*, as well as a *password* and an *avatar* image. Since a user can participate to several trips (or actions) and a trip (or action) can contain several users, a junction table 'MANY to MANY' exists to link trips (or actions) to users: 
    + trips_users: This table records all users that belong to a specific trip. When creating a trip, the owner is registered as the only participant of the trip. Then, he can add other users to participate to his trip.
    + actions_users: Each action can be performed by 1 (at least) to all participants of the trip (proposed by default in the view). 
2. **trips**: A trip will be created only a few times. A trip has a specific *name*. It also has a preferred *currency*, depending if the user wants to use the local currency or its own currency. The trip creator is the only one that can edit the trip settings and thus, a *owner_id* property is defined for each trip. Finally, it has a *starting* and *ending* date, that is not necessarily the first and last dates of its actions. 
3. **actions**: The actions will be the most often updated table with most fields. Many actions will be created for a specific trip. Each action has its type, owner and name (required properties). All other properties are not mandatory, like action information (company, reservation, identifier, note). Each action can have a price and a currency. Finally, each action can also have a starting and ending *datetime*, *name*, *longitude* and *latitude*   
    + **payments**: An action can be paid in several payments. All payments *amounts* are stored in this table that also provides the *payment method*, *currency* and *date* information.
    + Each payment can be done with a specific payment method (table **methods**)
    + **types**: Each action belongs to a specific type. A typical type would be Plane, Boat, Hotel, Bank, etc... 
    + each type belongs to a specific category (table **categories**). In order not to have too many types, these latter are categorised in 4 categories: Travel, Lodging, Activity, Other

##User interface

###Personas
3 set of _**'personas'**_ have been imagined as typical users of this website: 
1. **A person travelling alone**: 
    * 35 years old
    * Use the app to plan a three weeks trip to Australia.
    * He use the map to plan his trip much in advance
    * Wants to visually see his trip on a map and budgetise his trip. 
    * Only flights and car rental expenses are managed with the app.
    * Bank withdrawns are recorded with the app and all is payed cash (but not recorded)
2. **A couple travelling together**:
    * 30 years old
    * Trip to Bali. 
    * All is recorded before the trip. 
    * Records Flights, Hotels and excursions. 
    * The couple have mainly common expenses and share everything, except a few personal expenses.
3. **Group of 5 friends travelling together**: 
    * 20 years old.
    * Trip to London. They all meet in london and some will record their flight separately. 
    * Use of the app mainly during the trip. Real-time use.
    * The rest of the expenses and activities are payed in common, one after the other, how it happens. 

###User tests
1) A first set of tests have been performed with an [interactive prototype](/files/ShareMyTrip.pdf). The feedbacks were the following: 
    + Access to the trip details is not evident. The user instinctively pressed on "settings" instead of the trip details (=> Action taken: button "plan the trip")
    + Navigation: Confusion about where we go when we press on "Plan", "Maps" or "Budget" since no trip has been chosen. (=> Action taken: As long as no trip has been chosen, only "Trip" and "Profile" are enabled)
    + Private action: It would be nice that everybody can see all actions, in order that they can themselves decide to "join" an action. A "private" checkbox would allow us to register actions that we don't want to share. (Action taken => For version 2, since it means that we should represent the "Plan" with subgroups, a bit like we represent a new branch in Git)
    + Specific currency per trip. Many expenses would be recorded directly in the local currency. It should then deal with currency and currency rates. (Action taken: none yet, but for version 2 since it requires to plug to an external currency API and take the change rate at a specific date into consideration). 
    + Map directly on "Add/Edit action". (=> Action taken: Implemented with google map).
    
2) A second set of tests have been realised directly on the website. 
    + It's still complicated to understand the payment logic and how the calculation is done for the "Balance". Then, a row "TOTAL trip" has been added and the "Balance" row has been changed to "Still to pay". 
    + Not logical where to manage the users (Action taken => trip participants are separated from the "trip settings button" but now have a separate button)
    + What is the color logic? 

For both tests, the scenario was the following:

Brad wants to organise a trip for Angelina and him to Italy to see his friend George. 
1. Mr. Pitt uses his laptop to register himself with the following information:
    + Email: pitt@email.com
    + First name: Brad
    + Last name: Pitt
2. Ms. Jolie register herself on her cell phone (Use your phone to register her) with the following information: 
    + Email: jolie@email.com
    + First name: Angelina 
    + Last name: Jolie
3. Brad creates a new trip called 'Italy' from the 1st May to the 5th May 2017. He will use Euros for his budget calculation. 
4. Then, Brad adds Angelina to his trip to Italy in order that Angelina can access to the trip too. 
5. Brad adds the flight from Los Angeles (departure the 2017-05-01 at 15:30) to Milano (arrival the next day at 12:30) with Swiss. The flight costs 2000USD per person and Brad pays it all with his credit card. 
6. On her side, Angelina books a Limousine from Milano to Como. The agency estimate 5 hours to reach Como and it will cost 800 USD. Angelina will pay when arrived at destination. 
7. At L.A. airport, Angelina buy a pair of Gucci shoes for 600 USD. Brad won't pay for that shit! He is upset and have a few whiskeys in the plane... 
8. The next day, George and Brad decide make a motorbike trip to Locarno in Switzerland. Of course, George already has an account in ShareMyTrip (clooney@email.com) and Brad adds him into the 'Italy' trip. 
9. Brad forgot his purse home and thus, it's George who pays for the gasoil and drinks: 200 Euros.
10. Let's do the expenses calculation now... Check the Budget page and deduct what Angelina has to give to George and Brad to balance the expenses. 



###Prototyping
The prototype has been first created on paper and tested on several users. The user interface has been validated with a 3 steps process: 
 1. A paper prototype for the first ideas and tests
 2. An interactive prototype (available in [pdf](/files/ShareMyTrip.pdf)) to test the desktop and mobile versions
 3. A final test directly on the website for minor adjustments

###Responsiveness
Since this website is supposed to help travellers to manage their travel in all stages and any environment, it was important that it is working as well for desktop (for trip planification) and for mobile devices (for easy and fast trip updates and consultation). Thus, [bootsrap](http://getbootstrap.com/) has been used as a base html/css/js framework for responsive design. 


##TODO (short-term)
* Add color codes on Plan page
* Remove mandatory name on actions
* confirm trip user deletion
* Add link on the whole 'action' class and not only on the icon to edit an action
* Page Add/Edit an action
    + create 'Pay all' button
    + show the payment method in the list of payment in page Add/Edit action

##Known Bugs (short-term)
* You can add a trip without a name
* On "add action" page, payment cannot be deleted, date has not the right format.
* You cannot empty the arrival name location (google map) when add/edit an action
* You can add a user twice into a trip
* When there are no action, the budget page is not working (You can access it when adding your first action)

##Future developments (long-term)
* Currency is not implemented yet
* Timeline in Plan
* Budget page: Make summary box of what's left to pay (and show an overview also on trip page)




