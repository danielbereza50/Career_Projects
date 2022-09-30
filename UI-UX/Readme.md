When ever doing UX from scratch, use the following start to the code:

<style>
    
	    .flex-wrapper {display: flex;flex-wrap: wrap;justify-content: space-between;align-items: center;}

	    .flex-item {width: 32%;height: auto;}


	    @media screen and (max-width:980px){width: 50%;height: auto;}

	    @media screen and (max-width:768px){width: 100%;height: auto;}
    
    
</style>

    <div class = "flex-wrapper">

    <div class = "flex-item">

    <!-- stuff goes here -->

    </div>

    </div>


perserve image aspect ratio:

    aspect-ratio: 16/9;
    
	width: 200px;
    
    height: 200px;
    
	object-fit: cover;
	
	
	*Above the fold means within the viewport (not below the window height) 
	
	
	plugin in font family as the first value after loading .otf or .ttf file into project folder:
	
	font-family: 'Neon Blitz',Helvetica,Arial,Lucida,sans-serif;


