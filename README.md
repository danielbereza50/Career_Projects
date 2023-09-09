# Career_Projects


A portfolio of past projects, build instructions and platforms are specified at the start of each branch in order to ensure proper compilation. Everything is situated within its proper branch which is accessed through the drop down.

https: https://github.com/danielbereza50/asp.net.git

SSH: git@github.com:danielbereza50/asp.net.git


******hosting: https://www.smarterasp.net/index


download ASP.NET here: https://visualstudio.microsoft.com/vs/mac/


Tutorial: Get Started with Entity Framework 6 Code First using MVC 5
https://learn.microsoft.com/en-us/aspnet/mvc/overview/getting-started/getting-started-with-ef-using-mvc/creating-an-entity-framework-data-model-for-an-asp-net-mvc-application


open in Visual Studio

            How to view database: https://database.guide/how-to-install-sql-server-on-a-mac/

            Download Azure Data Studio:

https://learn.microsoft.com/en-us/sql/azure-data-studio/download-azure-data-studio?view=sql-server-ver16

*My installation is pointing here: https://localhost:5001 

install local: /Users/danielbereza/Projects


Full Stack Engineer (Microsoft Stack 64 bit architecture) - ASP.NET

Operating Systems: Mac, Windows, Linux

ASP.NET Cookbooks:

Download on to your local machine, to your desktop and then drag-and-drop unzipped folder into solution window This was built with Visual Studio Community 2017 for Mac

https://dottutorials.net/top-open-source-asp-net-core-cms/

https://github.com/OrchardCMS/OrchardCore

    Create a new branch on github
    Create a new project in visual studio
    Version Control -> Manage Branches and remotes, plugin https address from git
    commit changes on visual studio and push to git


https://github.com/danielbereza50/asp.net



how to publish local asp.net core project to godaddy sub domain

https://www.youtube.com/watch?v=2apoQVKO4Ow

            
            1. right click project in solution explorer
            2. Click publish project
            3. ftp://subdomain
            UN, PW
            4. edit web.config

            a) '<customErrors mode = "off" />'
            
            b) '<trust level = "full" />'
            
            c) <system.codedom>remove everything there</system.codedom>





            Web Server is IIS
            Database server is T-SQL


            https://ca.godaddy.com/help/software-versions-installed-on-linux-hosting-windows-hosting-and-managed-wordpress-accounts-897


            Linux Hosting with cPanel
            Component	Version
            Apache	2.4.46
            cURL	7.19.7
            MySQL	5.6.49
            5.7.38
            PHP	5.6
            7.3
            7.4 (default)
            8.0
            8.1
            PEAR	1.10.5
            Perl	5.10.1
            phpMyAdmin	4.9.4
            Python	via Python Selector
            2.7.18
            3.3.7
            3.4.9
            3.5.9
            3.6.11
            3.7.10
            Zend	3.3.26
            cPanel Control Panel	86.0.30



            Classic ASP and VB.NET or C#.NET
            Windows Hosting with Plesk
            Component	Version
            Operating System	Windows Server 2019
            ASP	3.0 (VBScript version 5.8)
            ASP.NET	3.5.30729.4926
            4.8.03761
            cURL	7.59.0 (PHP 5.6)
            7.70.0 (PHP 7.3 & 7.4)
            7.76.1 (PHP 8.0)
            7.70 (PHP 8.1)
            7.85.0 (PHP 8.2)
            IIS	10.x
            MSSQL	Europe & Asia: MSSQL 2019
            North America: MSSQL 2019
            Starter Plesk only: MSSQL not supported
            MySQL	5.7
            .NET Core	2.1.x
            3.1.x
            5.0.x
            6.0.x
            7.0.x
            PHP	5.6
            7.3
            7.4
            8.0
            8.1
            8.2
            phpMyAdmin	5.2.1
            IIS URL Rewrite Module	7.1.1993
            Plesk Control Panel	Obsidian (18.x)
            
            

            open solution /project-folder/second-project-folder/project.csproj
            


            Database connection string: 

            https://community.godaddy.com/s/question/0D53t00006VmDkACAV/a-webconfig-connection-string-for-ms-sql-server-and-the-wingtiptoys-demo
            
            Data Source=vvv.www.xxx.yyy;Initial Catalog=NameOfYourDb;Integrated Security=False;User ID=YourDbLoginId;Password=YourPassWord;Connect Timeout=15;Encrypt=False;Packet Size=4096;


            where:
            
            vvv.www.xxx.yyy is the IP address of your db server, discoverable in my LittleAdmin on the Connection Info link, Connection tab.
            
            NameOfYourDb is the actual name of the your GoDaddy SQL Server database, no backslashes, pipes, or .mdf, - just the name.
            
            YourDbLoginId is the Username you assigned when you created your GoDaddy SQL Server database.
            
            YourPassword is the password you entered when you created your GoDaddy SQL Server database.
 
            No MVC, creating Razor pages as is: 

            A. Right click pages folder > add new item > ASP.NET CORE > Razor Page (with page model)

            B. With MVC, create new folder for page, 
            1. 'Resource' under it file called 'Index.cshtml', 
            2. A new resource controller in the view folder. 
            3. A new controller file called ResourceController.cs with a method like:

            // includes
            using Microsoft.AspNetCore.Mvc;
            
            public class ResourceController : Controller
            {
                public IActionResult Index()
                {
                   return View();
                }
            }

             4. Home Controller class file update:
             
             public IActionResult LoadData()
             {
                    // Simulate loading data
                    return Content("Data loaded via AJAX request.");
             }

             5. Back in Resource > Index.cshtml ajax request will look something like this:
             // alert('fffff');
                        $.ajax({
                            url: '/Home/LoadData', // Update with your controller/action route
                            method: 'GET',
                            success: function (response) {
                                $('#ajaxResponse').html(response);
                            },
                            error: function (error) {
                                console.log(error);
                            }
                        });
                    });
             
             6. _Layout.cshtml

              <li>
                        <li><a class="nav-link text-dark" href="@Url.Action("Index", "Resource")">Resources</a>
              </li>

              7. When user navigated to that page, should show content
            
            
