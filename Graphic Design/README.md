Great article on modern web design:


https://www.webfx.com/blog/web-design/modern-web-design/


Mockups: 500 x 1500


CSS transforms: 

https://thoughtbot.com/blog/transitions-and-transforms

.class:hover{transition: all 1s; transform: scale(2);}

CSS for custom cursor image:

*  { cursor: default; cursor: url('/wp-content/uploads/2022/10/cursor-final.png'), auto }


image size: 128 x 128 max


CSS keyframes:

https://www.w3schools.com/cssref/tryit.asp?filename=trycss3_keyframes

.my_class {
  animation: mymove 5s infinite;
}

@keyframes mymove {
  from {top: 0px;}
  to {top: 200px;}
}

<div class = "my_class"></div>


        scolling bg image

        .scroll-container {
          width: 100%;
          height: auto;
          background: url('/wp-content/uploads/2022/08/AdobeStock_480762061-scaled.jpeg') repeat-x;
          background-size: 90%;
          animation: scroll-anim 15s linear infinite;
        }
        .scroll-container::before {
          content: "";
          width: 100%;
          height: auto;
          position: absolute;
          background: url('/wp-content/uploads/2022/08/AdobeStock_480762061-scaled.jpeg') repeat-x;
          background-size: 90%;
          animation: scroll-anim 10s linear infinite;
        }
        .scroll-container::after {
          content: "";
          width: 100%;
          height: auto;
          position: absolute;
          background: url('/wp-content/uploads/2022/08/AdobeStock_480762061-scaled.jpeg') repeat-x;
          background-size: 90%;
          animation: scroll-anim 5s linear infinite;
        }
        @keyframes scroll-anim {
          100% {
            background-position: -100% 0;
        }






Great logo maker:

https://www.canva.com/tools/logo-maker-q1/?utm_source=google_sem&utm_medium=cpc&utm_campaign=REV_US_EN_CanvaPro_Logo_EM&utm_term=REV_US_EN_CanvaPro_Online_Logo+Creator_EM&gclid=Cj0KCQjwytOEBhD5ARIsANnRjVj54juDpO99KMfI28v1bbeJ6JPBTX2PE7Iqp3Ag-24TEyirUrc0LboaAutYEALw_wcB&gclsrc=aw.ds
