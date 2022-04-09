When ever doing UX from scratch, use the following start to the code:

<style>
    
    .flex-wrapper {
    <br>
    display: flex;
    <br>
    flex-wrap: wrap;
    <br>
    justify-content: space-between; 
    <br>
    align-items: center;
    <br>
    }
    
    .flex-item {
    <br>
    width: 32%;
    <br>
    height: auto;
    <br>
    }
    
    
    @media screen and (max-width:980px){width: 50%;height: auto;}
    
    @media screen and (max-width:767px){width: 100%;height: auto;}
    
    
</style>

    <div class = "flex-wrapper">

    <div class = "flex-item">

    <!-- stuff goes here -->

    </div>

    </div>
