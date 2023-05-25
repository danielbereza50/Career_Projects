		When ever doing UX from scratch, use the following start to the code:

		<style>
		.flex-wrapper {
				display: flex;
				flex-wrap: wrap;
				justify-content: space-between;
				align-items: center;
		}
		.flex-item {
				width: 32%;
				height: auto;
		}
		@media screen and (max-width:980px){
			.flex-item {
				width: 50%;
				height: auto;
			}
		}
		@media screen and (max-width:768px){
			.flex-item {
				width: 100%;
				height: auto;
			}
		}
		</style>

		    <div class = "flex-wrapper">

		    <div class = "flex-item">

		    <!-- stuff goes here -->

		    </div>

		    </div>


		perserve image aspect ratio:

			https://web.dev/aspect-ratio/

			width: 200px;

			height: 200px;

			object-fit: contain;


			*Above the fold means within the viewport (not below the window height) 


			plugin in font family as the first value after loading .otf or .ttf file into project folder:

			font-family: 'Neon Blitz',Helvetica,Arial,Lucida,sans-serif;
			
			h1, h2, h3, h4, h5, h6{}
			body{}
			
			font-family: 'Muli',sans-serif !important;



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">




	Motion Effects(elementor examples):

	HORIZONTAL SCROLL

	Direction
	To Left

	Speed
	1

	Viewport
	0% - 60%

	VERTICAL SCROLL

	Direction
	Down

	Speed
	1

	Viewport
	41% - 71%



	Designer thoughts: 

	a. the gallery vs. image modules, give the ability for images to be displayed in a lightbox (pop up) when you click on them. 
	this is especially important for people using a phone
	b. if the pictures are in the first column of the first row, the user won't see the text until they scroll through all of the pictures. 
	The copy is written very well, and I think anyone who intends on making a purchase will read it.


	it's not a redesign, just a shuffling and refreshing of content.




