<h1 align="center">Applied Project And Minor Dissertation </h1>

# Table of contents

1.  [Project Details](#ProjDetails)

2.  [Video Demonstration](#VidDem)

3.  [Overview](#OverView)

4.  [Dissertation](#Dissertation)

5.  [Technologies](#Tech)
   
    5.1 [Xampp](#Xampp)
    
    5.2 [MySQL](#MySQL)
    
    5.3 [AdminLTE](#AdminLTE)
    
    5.4 [Php](#Php)
    
    5.5 [Javascript/Ajax](#JSA)
    
    5.6 [TCPDF](#TCPDF)
    
    5.7 [Excel](#Excel)
    
    5.8 [Chart](#Chart)

6. [Cloning](#clone)

7. [Remote Orders/ Untit Testing](#Remote)

# Project Details <a name="ProjDetails"></a>

| Project Details   |     |
| --- | --- |
| **Course** | BSc (Hons) in Software Development  |
| **Module** |  Applied Project and Minor Dissertation |
| **Institute** | [Galway-Mayo Institute of Technology](http://www.gmit.ie/) |
| **Students** | Mark Gilmore & Joseph Griffith |
| **Project Supervisor** | Martin Hynes| 
| **Module Supervisor** | Dr. John Healy |
| **Project Title** | Restaurant Management and POS System |

# Video Demonstration <a name="VidDem"></a>
Below is a video demo of the Restaurant Management and POS System can be found below where we demonstrate how the project functions:
**Link:** https://www.youtube.com/watch?v=eIOMU4gAIvA

# Overview <a name="OverView"></a>
This repository contains code and documentation developed for our 4<sup>th</sup> year module, Applied Project and Minor Dissertation.
The aim when creating this Restaurant Management and POS System is to address challenges in user productivity in a POS while maintaining accurate data on the transactions and business proceedings by developing a restaurant management system and the main goal of our project is to create a universal web-based restaurantmanagement and point-of-sale system with remote ordering capabilities. This web application was developed using Xampp, MySQL, AdminLTE, Php, Javascript/Ajax, TCPDF and Excel


# Dissertation <a name="Dissertation"></a>
Below is the Dissertation PDF of our project. The Dissertation was completed using LaTex(Overleaf), it contains an indepth view of the ins and out of the project ranging from the conception of the project to the conclusion and final thoughts.

**Link:** https://github.com/markgilmore10/Final-Year-project/blob/master/Overleaf/POS.pdf

# Technologies <a name="Tech"></a>

## Xampp <a name="Xampp"></a>
XAMPP is a free and open-source cross-platform web server solution stack package developed by Apache Friends, consisting mainly of the Apache HTTP Server, MariaDB database, and interpreters for scripts written in the PHP and Perl programming languages.


![Xampp](https://github.com/markgilmore10/Final-Year-project/blob/master/xampp.png)

## MySQL <a name="MySQL"></a>
MySQL is free and open-source software that acts as a relational database based of off the Structured Query Language - SQL, reasons to use MySQL include Secure Money Transactions, On-Demand Scalability, High Availability, Rock-Solid Reliability and Quick-Start Capability.

![MySQL](https://github.com/markgilmore10/Final-Year-project/blob/master/mysql.png)

## AdminLTE <a name="AdminLTE"></a>
AdminLTE is a popular open source WebApp template for admin dashboards and control panels. It is a responsive HTML template that is based on the CSS framework Bootstrap 3. It utilizes all of the Bootstrap components in its design and re-styles many commonly used plugins to create a consistent design that can be used as a user interface for backend applications. AdminLTE is based on a modular design, which allows it to be easily customized and built upon. This documentation will guide you through installing the template and exploring the various components that are bundled with the template.

![AdminLTE](https://github.com/markgilmore10/Final-Year-project/blob/master/adminlte.png)

## Php <a name="Php"></a> 
PHP is a server side scripting language. that is used to develop Static websites or Dynamic websites or Web applications. PHP stands for Hypertext Pre-processor, that earlier stood for Personal Home Pages. PHP scripts can only be interpreted on a server that has PHP installed.

![Php](https://github.com/markgilmore10/Final-Year-project/blob/master/php.png)

## Javascript/Ajax <a name="JSA"></a>
JavaScript (JS) is a lightweight, interpreted, or just-in-time compiled programming language with first-class functions. While it is most well-known as the scripting language for Web pages while AJAX = Asynchronous JavaScript and XML. AJAX is a technique for creating fast and dynamic web pages. AJAX allows web pages to be updated asynchronously by exchanging small amounts of data with the server behind the scenes. This means that it is possible to update parts of a web page, without reloading the whole page.
![JS/Ajax](https://github.com/markgilmore10/Final-Year-project/blob/master/js.png)

## TCPDF <a name="TCPDF"></a>
You can use TCPDF to generate myriad 1-D and 2-D barcode formats, and it supports all of the usual PDF features like bookmarks, document links, compression, annotations, document encryption, and digital signatures.
![TCPDF](https://github.com/markgilmore10/Final-Year-project/blob/master/tcpdf.png)

## Excel <a name="Excel"></a>
Microsoft Excel is a spreadsheet program. That means it's used to create grids of text, numbers and formulas specifying calculations. That's extremely valuable for many businesses, which use it to record expenditures and income, plan budgets, chart data and succinctly present fiscal results.

![Excel](https://github.com/markgilmore10/Final-Year-project/blob/master/excell.png)

## Charts/Graphs <a name="Chart"></a>
The charts were created using Morris.js and Chart.js plugins.
Morris.js lets the user create aesthetic charts in next to no time, it is made very simple using the public api for each chart, We decided to go with this as it was shown as a chart in the AdminLTE dashboard that looked exactly what we were looking for. We used Morris.js to create line and bar charts.

Chart.js like Morris.js, Chart.js is a free open-source JavaScript library for data visualization, Chart.js was also found on the dashboard we decided to go with this plugin as it's beautifully constructed charts such as their animated pie chart is what struck out to us. 

![Chart](https://github.com/markgilmore10/Final-Year-project/blob/master/chartjs.jpg)

# Cloning/Running the application <a name="clone"></a>
To clone the application navigate to the directory you wish to have the project in once there, input the following command: 
```
git clone https://github.com/markgilmore10/Final-Year-project.git
```

Download and set up a Xampp local server. 

**Link:** https://www.apachefriends.org/index.html

Insert the cloned project folder into the htdocs folder from Xampp.

Download and set up Wamp.

**Link:** https://sourceforge.net/projects/wampserver/

Import the database using: 
**Link:** https://github.com/markgilmore10/Final-Year-project/blob/master/restaurantpos.sql

Finally navigate to localhost/pos.

# Remote Ordering / Unit Tests <a name="Remote"></a>
Unfortunately neither of us have access to a tablet in which we could use for remote ordering, this function was although tested before Covid19 by connectiong to the same IPv4 address as the computer in which Xampp was running on.

As well as all of the above Unit tests were written for our application using PhpUnit to run created tests, all of our test can be found in the **Link:** https://github.com/markgilmore10/Final-Year-project/tree/master/tests/unit folder. These tests can be run using PhpUnit and once ran all test pass the desired tests that were documented.

![Remote](https://github.com/markgilmore10/Final-Year-project/blob/master/unitTests.jpeg)
