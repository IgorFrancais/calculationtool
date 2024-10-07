# Calculationtool
The Big Calculation Tool 

# Project structure

Note: Docker configuration for starting application locally was tested on Mac with Apple M1 Pro

```sh
.
├── codebase/
├── docker/
│   ├── db/
│   │   └── mariadb/
│   │       └── my.cnf
│   └── server/
│       ├── apache/
│       │   └── sites-enabled/
│       │       └── site.conf
│       ├── php/
│       │   └── php.ini
│       └── Dockerfile
├── .env
└── docker-compose.yml
```

* ```codebase``` folder will hold all our project code
* ```.env``` file - there are project-level Docker environment variables
* ```docker-compose.yml``` YAML file is where our services are defined
* ```Dockerfile``` - used to specify what the server image looks like
* All other files in ```docker``` folder - used for different configuration

## How application works
1. Check http://localhost:8101/
2. Enter values for ```"Vehicle price"``` and ```"Vehicle type"```
3. Press button "Calculate" - form will be reloaded with calculated values

# Compromises on certain aspects of the code
 To calculate and show all values BackEnd approach is used (form is reloaded with calculated values)   
        
### Way to improve (Frontend side)  
1. Field, which will be calculated - make non-editable (```Fee basic, Fee special, Fee association, Fee storage, Total```)
2. Remove button ```"Calculate"```  
3. Field ```Vehicle type``` make as Dropdown with 2 options: ```Luxury, Common``` (so, always some of these values is selected)   
4. With JavaScript, on event when the value of the field ```"Vehicle price"``` is changed:   
    4.1. It's null - clean all others fields  
    4.2. Not null - recalculate all others fields
5. With the styling add some beauty for the form (for example, left border of input fields are on the same level etc)   

### Way to improve / comments (Backend side) 
1. Database is not needed in this application, so the following folders are empty: ```migration``` and   ```Repository```.
2. ORM comments (like ```#[ORM\Column]```) for the Entity's fields are not needed.