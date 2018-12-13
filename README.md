#############################################################################################

ENVIRONMENT USED FOR DEVELOPMENT :- UBUNTU 18.04, PHP 7, JSON, APACHE, CHROME BROWSER as a client


# Installation process

execute from command line

$> git clone https://github.com/adityapandey89/farmgame.git
$> cd /var/www/html/farmgame
$> mkdir runtime
$> sudo chmod -R 777 runtime/

From your client browser

http://localhost/farmgame/public

How to Play

# All the FARM LIFE is highlighted as RED (this is a known bug to be will be fixed)
# Click on feed button
# If FARMER is dead GAME OVER YOU LOST
# If FARMER, atleast 1 COW and 1 BUNNY alive: after 50 feed you WIN
# Click New Game Button to start again

#############################################################################################

# Farm Game
**Objective**

Create a PHP application that performs the following game.

A web page must be produced as the interface to play the game. Styling is neither expected nor necessary.

The application must run in a browser.

**The game**

You have a farm with:

- 1 farmer: needs to be fed at least once every 15 turns.
- 2 cows: each cow needs to be fed at least once every 10 turns.
- 4 bunnies: each bunny needs to be fed at least once every 8 turns.

If any of the animals or the farmer are not fed on time, they die. If the farmer dies, all animals die and the game is over.

The game ends after 50 turns. If the farmer and at least one cow and one bunny are still alive at that point, you win.

**How to play**

- There’s a button to start a new game.
- There's a single button to feed the farmer and the animals. 
Every time you click on that button, the system randomly chooses whom to feed. 
Every click on this button is a turn. The maximum number of turns is 50.
Don't focus on winning or losing, but on building the game as described.

**What we expect**
- Create a new branch for you to use and push your code.
- Add all commits when possible, so we can see your work process.
- Highlight your PHP skills.
- But also add unit tests wherever appropriate.

Good luck, and thanks for your time and interest :+1:
