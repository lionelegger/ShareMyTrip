# Share my trip

> _"Keeping the *Let's Go* and taking the *Uh-Oh* out of travel"_

Made by [Lionel EGGER](mailto:lionelegger@gmail.com)

## What is 'Share My Trip'?
_[Share my trip](http://www.lionelegger.com/sharemytrip)_ is a website that helps travellers to plan, map and budget a trip. When you travel alone, make the expenses is easy... But what happens when you travel with friends and share bills? Sometimes you pay for all your group of friends, sometimes you organize excursion only with a subgroup of friends. What's about when you buy yourself a souvenir, it should not be on the common bill... The trip budget can very quickly be a complex task to calculate. ShareMyTrip makes travelling together easy and facilitate all expenses calculation. It helps you to plan, manage and visualize your future trips. 

## How to use the website
When you arrive to the homepage, you have two possibilities: login or register as a new user. If you don't have already an account, please register and you will be automatically logged in after registration. 
Once logged in, you arrive on the Trip page. You can always change your personal information by clicking on your avatar or name on the top right corner. You will arrive on your Profile page. 

### Profile page
This page allows you to modify your personal information, as well as to change your avatar picture or even upload another one (Please use 300px by 300px or any other light square picture). NB: Be aware that the changes in your profile will be visible only after logout and login again. 

### Trip page
This page is the landing page after a users logs in. It lists all trips a user is participating in (the newest would appear first). When you have no trip yet, a welcome message indicate the 3 main steps the user should do: "Add a trip", "Add users" and "Add actions". In the beginning, only the "Add a trip" option is available.  
* **Add trip**: This will add a new trip with the _trip name_ as a mandatory option. All others options are optional. The _currency_ defines which currency will be used as the default one for the new trip. You might want to manage most of your expenses in the foreign currency. NB: The currency functionality is saved but yet no currency rate has been implemented yet. The dates are also not mandatory if they are not known yet. You can always change the trip setting by clicking on the "settings" button on the top right corner of a blue trip box. The person who creates the trip is the only one that has access to the 'settings' functionality and thus, the only one that can add users and change the trip name, currency and dates.
* **Add user**: Each trip can be done alone or with friends. If you travel alone, you can directly "Plan this trip". If you travel with friends, click on "Add a user" and the system will ask you to provide an email address. The email address you enter here should be the login (email address) of another user already registered in the system. Theoretically, you can add as many friends as you want but the interface gets messy with more than 10-12 users. Once your trip defined, you can go to the next step by pressing the "Plan this trip" button. You will reach the "Plan page".

### Plan page
The plan page gives you an overview of all trip actions organised by date. You can also easily see which action is not paid, partially paid or full paid thanks to the action color codes. Each action is represented by a single dot when the action is defined by a unique starting time/spacial entry; or by two points when an ending time or location has been defined. Each action is editable by clicking on the action icon. When an action extends to the next day, the ending date appears on the right side of the action line. The logged user only sees the actions in which he is participating. 

### Add/Edit an action page
'Add an action' button is visible on 'Plan', 'Map' and 'Budget' pages in order to quickly access to this page that will be widely used. 'Edit an action' is reached anytime you click on the action icon, from any of these pages too. Only the owner (creator) of an action can delete it but any participating user can edit the action.
* Actions are classified in **4 categories**: Travel, Lodging, Activity and Other. Each category is composed of several **types**. The action type is a mandatory field. When you choose the Lodging category, you logically don't have an ending location.
* All other actions can be described with a **starting and ending time and location** but these fields are not mandatory. If the ending date is not filled, it presupposed that it's the same date as the starting date. 
* The **name** of the action is mandatory. It describes the action. 
* The 'Company', 'Reservation', 'Identifier' and 'Notes' fields are not mandatory and can be useful to detail an action. For example, the flights or hotel details are typically entered here.
* **Share**: This field specifies with whom you will share the specific action. By default, you share an action with all participants of the trip. But you can restrict the action scope to only some users or even for you only. For example, if you travel with another couple, one couple could have a superior room which means a higher cost. It would also be used when a participant of the trip joins you for only a part of the trip. The flights can be also registered separately if participants of a trip meets in a city and then travel together. For a personal expense, you can press the 'only me' button.
* **Expenses**: The expenses box is separated in two sections: 
  * **Price**: Define here the total price of the action. It means that it does not represent the individual price, but it encompass the global price for all participants. The price is not mandatory as we can plan an action without knowing the price in advance or even register free actions. 
  * **Payments**: The totality of an action price is not necessarily paid in one go. For example, you might have to pay a first installment before the trip and what's left must be paid on site. You can register all payments here and the sum will be automatically calculated, as well as what's left to pay. The status of the global payment is updated at each payment registration and the sum is in the currency defined in the trip settings (not yet implemented). 

### Map page
The map page shows on a google map all actions that have been geolocalised. 

### Budget page
The budget page summarise all expenses made by all trip participants. The price of the action on the right is the price defined in the "add/edit action" page. At the bottom of the page, the "TOTAL paid" row indicates the totality paid for each participant. Below, the "TOTAL trip" shows the totality that each participant should pay. And finally, the last row "Still to pay" is the balance between the amount paid and to be paid... These values are dependent of the user since all users do not necessary takes part in the same actions.   


## Website Architecture
ShareMyTrip website is based on **Model-View-Controller** (MVC) software design pattern. 
* The Database is a **MySql database** managed by **[cakePHP](https://cakephp.org/)**, a php framework. . 
* The controller is managed with **cakePHP** too. This latter provides JSON feeds to the views. 
* The views are html5/css3 with a layer of angularJS. AngularJS send JSON requests to the controller and updates the view in consequence. 

## Database
The [database](/files/ShareMyTrip-DB.pdf) contains 9 tables organised around 3 main tables: users, trips and actions

1. **users**: This table is the core of the DB. In order to use the website, you need first to login or create a user account. This latter has an *email*, *first name* and *last name*, as well as a *password* and an *avatar* image. Since a user can participate to several trips (or actions) and a trip (or action) is made by several users, a joint table 'MANY to MANY' links trips (or actions) to users: 
2. **trips_users**: This table records all users that belong to a specific trip. When creating a trip, the owner is registered as the only participant of the trip. Then, the owner can add other users to participate to his trip.
3. **actions_users**: Each action can be performed by 1 (at least) to all participants of the trip (this latter option is set by default). 
4. **trips**: A trip has a specific *name* that is mandatory. It also has a preferred *currency*, depending if the user wants to use the local currency relatively to the trip or another preferred currency. The trip creator (or owner) is the only one that can edit the trip settings and thus, a *owner_id* property is defined for each trip. Finally, it has a *starting* and *ending* date, that is not necessarily the first and last dates of its actions. 
5. **actions**: The actions will be the most often updated table with most fields. Many actions will be created for a specific trip. Each action has its type, owner and name (required properties). All other properties are not mandatory, like action information (company, reservation, identifier, note). Each action can have a price and a currency. Finally, each action can also have a starting and ending *datetime*, *name*, *longitude* and *latitude*   
6. **payments**: An action can be paid in several payments. All payments *amounts* are stored in this table that also provides the *payment method*, *currency* and *date* information.
7. Each payment can be done with a specific payment method (in table **methods**)
8. **types**: Each action belongs to a specific type. A typical type would be Plane, Boat, Hotel, Bank, etc... In order not to have too many types, these latter are categorised in 4 categories: Travel, Lodging, Activity, Other
9. Each type belongs to a specific category (table **categories**). 

## User experience

### Personas
3 set of _**'personas'**_ have been imagined as typical users of this website: 

1. **A person travelling alone**: 
  * Andy has 35 years old
  * He uses the app to plan a three weeks trip to Australia.
  * His preferred device will be his cellphone (iPhone 6) but sometimes will go to an internet cafe too. 
  * He wants to visually see his trip on a map and budgetize his trip mainly before leaving to Australia. 
  * Only big expenses like flights, few hotels and car rental are managed through the app. The rest is improvised.
  * Bank withdrawn are recorded with the app and all is payed cash (but not recorded)
  
2. **A couple travelling together**:
  * 30 years old
  * They travel two weeks to Bali 
  * They use a computer to plan the trip and the cellphone during the trip through hotel wifi. 
  * Most is recorded and paid before the trip by internet but some updates of actions/expenses during the trip. 
  * Records Flights, Hotels and excursions. 
  * The couple have mainly common expenses and share everything, except a few personal expenses.
  
3. **Group of 5 friends travelling together**: 
  * Around 20 years old.
  * They mainly use their cellphone (Android mainly).
  * 4 days trip to London. 
  * Use of the app mainly during the trip. Real-time use.
  * They all meet in london and some will record their flight separately. 
  * The rest of the expenses, like museums, bars and other expenses are registered only when payed in common by someone. 

### User tests
The user interface has been validated with a 3 steps process: 

1. A paper prototype for the first ideas and user tests

2. A second set of tests have been performed with an [interactive prototype](/files/ShareMyTrip.pdf). The feedbacks were the following: 
  * Access to the trip details is not evident. The user was selecting "settings" instead of the trip details to get to enter a trip (=> Action taken: button "plan the trip")
  * Navigation: Confusion about where to go when we press on "Plan", "Maps" or "Budget" when no trip has been chosen. (=> Action taken: As long as no trip has been chosen, only "Trip" and "Profile" are enabled)
  * Private action: It would be nice that everybody can see all trip actions, in order that any trip buddy is aware of the other's actions and can decide to "join" or not. A "private" checkbox would allow us to register actions that we don't want to share. (Action taken => For version 2, since it means that we should represent the "Plan" with subgroups, a bit like we represent a new branch in Git. It adds a new complexity)
  * Specific currency per trip. Many expenses would be recorded during the trip directly in the local currency. It should then deal with currency rates. (Action taken: none yet, but for version 2 since it requires to plug to an external currency API and take the change rate at a specific date into consideration). 
  * Map directly on "Add/Edit action" and not only when press on the 'localize' icon. (=> Action taken: Implemented with google map inputs)
  
3. A second set of tests have been realised directly on the website. 
  * It's still complicated to understand the payment logic and how the calculation is done for the "Balance". Then, a row "TOTAL trip" has been added and the "Balance" row has been changed to "Still to pay". 
  * Not logical where to manage the users (Action taken => trip participants are separated from the "trip settings button" but now have a separate button)
  * What is the color logic? (Action taken => Add a color explanation box at the bottom)

For the two last tests, the scenario was the following:

```
Brad wants to organise a trip for Angelina and him to Italy to see his friend George. 
1. Mr. Pitt uses his laptop to register himself with the following information:
  * Email: pitt@email.com
  * First name: Brad
  * Last name: Pitt
2. Ms. Jolie register herself on her cell phone (Use your phone to register her) with the following information: 
  * Email: jolie@email.com
  * First name: Angelina 
  * Last name: Jolie
3. Brad creates a new trip called 'Italy' from the 1st to the 5th of June 2017. He will use Euros for his budget calculation. 
4. Then, Brad adds Angelina to his trip to Italy in order that Angelina can access to the trip. 
5. Brad adds the flight from Los Angeles (departure the 2017-06-01 at 15:30) to Milano (arrival the next day at 12:30) with Swiss. The flight costs 1000USD per person and Brad pays only his part with his credit card. 
6. On her side, Angelina books a Limousine from Milano to Como. The agency estimate 5 hours to reach Como and it will cost 800 USD. Angelina pays the totality with a bank transfer. 
7. The next day (3rd June), George and Brad decide make a motorbike trip to Locarno in Switzerland. Of course, George already has an account in ShareMyTrip (clooney@email.com) and Brad adds him into the 'Italy' trip. 
8. Brad adds the motorbike trip with George for the full day. It costs 400€ for the rent, gasoil and a few coffees.
9. While the boys having fun on their bikes, Angelina goes shopping in Como and buys herself a pair of Gucci shoes for 600 USD (with her credit card). 
10. Let's do the expenses calculation now... Check the Budget page and make the refunds to balance the expenses. 
```
_SOLUTION: Georges and Brad gives each 200€ to Angelina; Then Angelina pays her flight 1000€ and all is paid... (it's still complicated...)_

### Responsiveness
Since this website is supposed to help travellers to manage their travel in all stages and any environment, it was important that it is working as well for desktop (for trip planification) and for mobile devices (for easy and fast trip updates and consultation). Thus, [bootsrap](http://getbootstrap.com/) has been used as a base html/css/js framework for responsive design. 

## Bugs/Improvements (version 1.1)
- [ ] Trips page: Don't allow to add a trip without a name
- [ ] Budget page: Sort users by first name
- [ ] Action page: Action property 'name' should not be mandatory
- [ ] Registration: When register a new user, put validation for email with message
- [ ] Plan page: Hide icons when they overlap
- [x] Add action page: payment cannot be deleted; date has not the right format; Show payment method
- [ ] Add/Edit action page: Allow to empty the arrival name location (google map) when add/edit an action
- [ ] Edit action page: If you are not the owner, you should not be able to remove the owner of the action as a participant (share box)
- [ ] Trips page: Don't allow to add a user twice into a trip
- [ ] Budget page: when no action has been created, links to Plan & Map are not working

## Future developments (version 2)
- [ ] Add a Change password functionality
- [ ] Implement Currency rate (with API)
- [ ] Timeline in Plan page
- [ ] Budget page: Make summary box of what's left to pay (How can we record refunds?)
- [ ] Trips page: Show a trip summary for each trip with: 
    - [ ] Time left before leaving
    - [ ] Total cost of the trip
    - [ ] Refund information to other participants
    - [ ] Statistics like trip duration, number of actions




