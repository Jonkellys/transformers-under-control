<div align="center">
  <a href="https://github.com/Jonkellys/transformers-under-control">
    <img src="./assets/img/logo.png" alt="Logo" width="100" height="100" />
  </a>
</div>

<h1 align="center" underline="none">Transformer Under Control</h1>
<p align="center">A simple inventory system to keep track of electric current transformers in one area.</p>

<div align="center">
  <a href="#about">About</a>    |    
  <a href="#start">Getting Started</a>    |    
  <a href="#usage">Usage</a>    |    
  <a href="#contributing">Contributing</a>     |   
  <a href="#license">License</a>
</div>

---

## [About](#about)

This project was built during my internship at a electricity company, at the moment of my arrival they keep all the information of the electric current transformers in the area on paper, so as part of my work there I built this systems to help them store their information in a faster, more organized, and secure way.



> **Note:** This is a copyright-free translated version of the original project made to protect the sensitive information found in the original.



### Key Features

- Stores, update, delete and print information about...
  
  - Transformers (Serial number, current state, type, brand, model, location, others).
  
  - Operations (Installing, Repairing, Removing).
  
  - Locations in the area.

- Analytics.

- Security.

- Records, you can print records with the information that you need on PDF format.

- Tracking and Controlling.

- Cross-platform.



### Built with

- HTML/CSS.

- Bootstrap.

- PHP.

- JavaScript.

- JQuery.

- XAMPP.

- MySQL.
  
  

## [Getting Started](#start)

### Prerequisites

You'll need to have install XAMPP on your computer to host the project. You can download it on: [apachefriends.org ]()



### Installation

1. Clone the repo
   
   ```
   git clone https://github.com/Jonkellys/transformers-under-control.git
   ```

2. Add the repository to your 'htdocs' folder.

3. Start XAMPP through the command line.
   
   ```
   sudo /opt/lampp/lampp start
   ```
   
   or open the graphical tool and start the servers.

4. Go to [phpMyAdmin](http://localhost/phpmyadmin/index.php?route=/) and 'Import' the database.
   
   - If you want a clean database Import the file 'empty_db.sql'.
   
   - Or, if you want a database with mock data to test the system Import the file 'mock_data_db.sql'.

5. Go to http://localhost/transformers-under-control/ on your preferred browser.



## [Usage](#usage)

Once you successfully install the project your first step is logging in to the system, you can do it with the following data:

- **Username:**  quietimpulse

- **Password:**  12345678



Once you logged in, you'll have full access to the system so feel free to explore all the features for yourself (It pretty self-explanatory).



## [Contributing](#contributing)

If you want to contribute to this project to enhanced and make it better you're very welcome to do it.



## [License](#license)

Distributed under the MIT License. See `LICENSE.txt` for more information.
