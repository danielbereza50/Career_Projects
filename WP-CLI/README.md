# Career_Projects
A portfolio of past projects, build instructions and platforms are specified at the start of each branch in order to ensure proper compilation.  Everything is situated within its proper branch which is accessed through the drop down.


SSH step-by-step:

ssh = secure shell

ssh root@[ip address]

password: [Password]


example:

ssh [username]@[ip address]

password: [Password]


scp -r [username]@[address]:/path/to/remote /path/to/local


cd /home/[project folder]

ls - list

pwd - print working directory

nano - text editor on ubantu



mkdir -  make a new directory

cat - to view a file's contents

cd - change directory

on a mac do control + X to exit nano

exit - to close the thread

// in case of PHP version errors
composer install --ignore-platform-reqs 



AWS Walkthrough:

sudo pip install awscli

aws configure list

aws configure

1. AWS Access Key ID
2. AWS Secret Access Key 
3. Default region name [US East]: us-east-2
4. Default output format [JSON]: json

aws s3 sync s3://<your_source_s3_bucket> <your_local_path>

example: 

aws s3 sync s3://domain.com desktop/test


How to get to the bin folder:

https://macpaw.com/how-to/access-bin-folder-mac

How to build a react js app
https://mailtrap.io/blog/react-contact-form/

/*   */


Siteground Walkthrough

    https://www.siteground.com/kb/how_to_log_in_to_my_shared_account_via_ssh_in_mac_os/
    
    1. Create private key from siteground
    2. Place folder on desktop
    3. run these commands
       -  chmod 600 desktop/private-key.txt
       -  ssh-add desktop/private-key.txt    

    4. ssh USER@HOST_NAME -pPORT
  

https://dev.to/julbrs/how-to-use-react-inside-a-wordpress-application-49i


Common commands that can be plugged-in to the terminal:

cd /Applications/MAMP/htdocs/wordpress/wp-content/plugins/

npx create-react-app my-app

## Available Scripts

In the project directory, you can run:

### `npm start`

Runs the app in the development mode.\
Open [http://localhost:3000](http://localhost:3000) to view it in the browser.

The page will reload if you make edits.\
You will also see any lint errors in the console.

### `npm test`

Launches the test runner in the interactive watch mode.\
See the section about [running tests](https://facebook.github.io/create-react-app/docs/running-tests) for more information.

### `npm run build`

Builds the app for production to the `build` folder.\
It correctly bundles React in production mode and optimizes the build for the best performance.

The build is minified and the filenames include the hashes.\
Your app is ready to be deployed!

See the section about [deployment](https://facebook.github.io/create-react-app/docs/deployment) for more information.

### `npm run eject`
