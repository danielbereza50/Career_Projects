<?php

add_shortcode('accordions-1', 'accordions1');
function accordions1(){

	ob_start();
?>
  <script>
  jQuery( function() {
    jQuery( "#accordion" ).accordion({collapsible : true, active : false});
	
  } );
  </script>
<style>
	
		#accordion-text{display: block;
margin-left: auto;
margin-right: auto;
width: 80%;}
	
	.ui-accordion .ui-accordion-header {
    text-align: left;
    margin-top: 1% !important;
    background-color: rgba(203, 186, 217, 0.05) !important;
}
	.number{ text-align: center;font-size: 45px;background-color: rgba(197, 169, 207, 0.1) !important;
padding: 39px 39px 39px 39px;font-weight: bolder;}


.description{padding-left: 80px; font-size: 24px;
padding: 29px 39px 43px 39px;font-weight: bolder;}



#extra1{
	padding: 54px 39px 43px 39px !important;
}

#extra{
	padding:54px 39px 43px 39px !important;
}
	
	
	
	.wrap{display: block;
margin: auto;
width: 70%;}
	
.number{display: inline-block;
width: 15%;}
	
	.description{display: inline-block;
width: 85%;}
	
	
	.wrap{display: block;
margin: auto;
width: 82%;}
	
	#categories1{cursor: pointer;}
	#categories2{cursor: pointer;}
	#categories3{cursor: pointer;}
	.cat1{text-align: left;float: left;width: 25%;color: #45668C;
font-weight: bold;}
	.cat2{text-align: left;float: left;width: 25%;color: #45668C;
font-weight: bold;}
	.cat3{text-align: left;float: left;width: 25%;color: #45668C;
font-weight: bold;}
	@media screen and (max-width:900px){
		.cat1{text-align: left;float: none;width: 100%;}
	.cat2{text-align: left;float: none;width: 100%;}
	.cat3{text-align: left;float: none;width: 100%;}
			.number {
    font-size: 22px;
}
	.description {
    font-size: 12px;
	}
				
	.number{width: 100%; }
.description{width: 100%;}
	}

</style>

<div class = "wrap">
<div style="min-height: 50px;">
	<div class = "cat1"><span id = "categories1">About DBT</span></div>
</div>
</div>

<div class = "wrap">
<div id = "intake">
<div id="accordion">
	<h3><span class = "number">01</span><span class = "description">What Is Dialectical Behavior Therapy or DBT?</span></h3>
  <div>
    <p id = "accordion-text">
DBT was developed by Marsha Linehan as an adaptation of cognitive behavioral therapy (CBT) for clients who, despite having insight into their problematic thoughts, emotions and behaviors, could not seem to change them. DBT is different from CBT in several ways, one of the most significant of which is that DBT aims to first change behavior in order to improve thoughts and feelings, whereas CBT focuses on changing thoughts and feelings in order to influence behavior. Do you find that despite having insight into your problems and a strong desire to change, you continue to engage in behaviors that cause you misery and distress? DBT also incorporates a significant mindfulness component.

DBT is an evidence-based treatment that effectively treats may disorders. Although it was developed to treat borderline personality disorder, it can be successfully applied to many others, such as eating disorders, anxiety and depression, post-traumatic stress disorder, and substance abuse. If you struggle with extreme emotions, interpersonal conflict and difficulty tolerating distress, DBT may be for you!
    </p>
  </div>
	
	<h3><span class = "number">02</span><span id = "extra" class = "description">How Can DBT Help Me?</span></h3>
  <div>
    <p id = "accordion-text">
    
DBT is a comprehensive treatment that is based on a model of looking at emotional and behavioral dysregulation called the biosocial theory. Have you been frequently told that you are too sensitive or too emotional, that you need to calm down or chill out or that you're too reactive? Biosocial theory states that your big emotions are biological, that you were born this way. Some people are born "emotionally vulnerable," and many of these people are raised in environments that don't know how to help them with their big emotions and, instead, end up invalidating them. This leads to emotional and behavioral dysregulation. DBT can help you understand yourself better and stop engaging in self-defeating thoughts, feelings and behaviors.

DBT is skills based. It works to foster self-acceptance in clients while also pushing them to change. This is DBT's central dialectic! Using DBT skills, you will learn to reduce distress, tolerate unavoidable distress without making things worse, regulate unwanted or ineffective emotions, and improve your relationships.

		DBT is an evidence-based treatment with many studies showing that DBT actually works! Visit the <a href = "https://linehaninstitute.org/evidence-for-dbt/">LinehanInstitute.org</a> to read about the research that supports the effectiveness of this amazing treatment.

    </p>
  </div>
	
	<h3><span class = "number">03</span><span id = "extra" class = "description">What Can I Hope to Accomplish?</span></h3>
  <div>
    <p style="width: 100%;" id = "accordion-text">
    Mindfulness
    </p>
    <ul>
      <li>Reduce suffering and increase happiness</li>
      <li>Increase control of your mind</li>
      <li>Experience reality as it is</li>
    </ul>
	  <p style="width: 100%;" id = "accordion-text">
    Distress Tolerance
    </p>
    <ul>
      <li>Survive crisis situations without making them worse</li>
      <li>Accept reality</li>
      <li>Replace suffering and being stuck with ordinary pain and the possibility of moving forward</li>
		 <li>Become free of having to satisfy the demands of your urges</li>
    </ul>
	  <p style="width: 100%;" id = "accordion-text">
    Emotion Regulation
    </p>
    <ul>
      <li>Understand and name your emotions</li>
      <li>Decrease the frequency of unwanted emotions</li>
      <li>Decrease emotional vulnerability</li>
		<li>Decrease emotional suffering</li>
    </ul>
	  <p style="width: 100%;" id = "accordion-text">
    Interpersonal Effectiveness
    </p>
    <ul>
      <li>Be skillful in getting what you want and need from others</li>
      <li>Build relationships and end destructive ones</li>
      <li>Walk the middle path</li>
    </ul>
	  <p style="width: 100%;" id = "accordion-text">
    *material adapted from DBT Skills Training Handouts and Worksheets, by Marsha Linehan
    </p>
  </div>

</div><!-- end of accordion -->
</div></div>


        <?php
	return ob_get_clean();
}

add_shortcode('accordions-2', 'accordions2');
function accordions2(){

	ob_start();
?>
  <script>
  jQuery( function() {
   jQuery( "#accordion" ).accordion({collapsible : true, active : false});
	  jQuery( "#accordion2" ).accordion({collapsible : true, active : false});
	  jQuery( "#accordion3" ).accordion({collapsible : true, active : false});
	  
 
    jQuery("#categories1").click(function() {
      jQuery("#intake").show();
      jQuery("#treatment").hide();
	  jQuery("#group").hide();
    });
	  
	  jQuery("#categories2").click(function() {
      jQuery("#treatment").show();
      jQuery("#intake").hide();
	  jQuery("#group").hide();
    });
	  
	  jQuery("#categories3").click(function() {
      jQuery("#group").show();
      jQuery("#intake").hide();
	  jQuery("#treatment").hide();
    });
	  
  } );
  </script>
<style>
	
	#accordion-text{display: block;
margin-left: auto;
margin-right: auto;
width: 80%;}
	
.ui-accordion .ui-accordion-header {
    text-align: left;
    margin-top: 1% !important;
    background-color: rgba(203, 186, 217, 0.05) !important;
}
	.number{ text-align: center;font-size: 45px;background-color: rgba(197, 169, 207, 0.1) !important;
padding: 39px 39px 39px 39px;font-weight: bolder;}


.description{padding-left: 80px; font-size: 24px;
padding: 29px 39px 43px 39px;font-weight: bolder;}


#extra1{
	padding: 54px 39px 43px 39px !important;
}

#extra{
	padding:25px 39px 43px 39px !important
}
	
	.number{display: inline-block;
width: 15%;}
	
	.description{display: inline-block;
width: 85%;}
	
	
	.wrap{display: block;
margin: auto;
width: 82%;}
	
	#categories1:active{font-weight: 700 !important;}
	#categories2:active{font-weight: 700 !important;;}
	#categories3:active{font-weight: 700 !important;}
	
	
	#categories1{cursor: pointer;}
	#categories2{cursor: pointer;}
	#categories3{cursor: pointer;}
	.cat1{text-align: left;float: left;width: 18%;color: #45668C;
font-weight: lighter;}
	.cat2{text-align: left;float: left;width: 15%;color: #45668C;
font-weight: lighter;}
	.cat3{text-align: left;float: left;width: 20%;color: #45668C;
font-weight: lighter;}
	@media screen and (max-width:900px){
		.cat1{text-align: left;float: none;width: 100%;}
	.cat2{text-align: left;float: none;width: 100%;}
	.cat3{text-align: left;float: none;width: 100%;}
		.number {
    font-size: 22px;
}
	.description {
    font-size: 12px;
	}
				
	.number{width: 100%; }
.description{width: 100%;}
	}
</style>
<div class = "wrap">
<div style="min-height: 50px;">
	<div class = "cat1"><span id = "categories1">Intake Process</span></div>
	<div class = "cat2"><span id = "categories2">Treatment</span></div>
	<div class = "cat3"><span id = "categories3">Group</span></div>
</div>
</div>

<div class = "wrap">
<div id = "intake">
<div id="accordion">
	<h3><span class = "number">01</span><span class = "description">When does the next module start and how do I enroll?</span></h3>
  <div>
    <p id = "accordion-text">
Our next module begins April 26th.

Enrolling is simple. Reach out to us via the contact form at the bottom of the page and we will set up an assessment session to determine if our program is a fit for you.
    </p>
  </div>
	<h3><span class = "number">02</span><span id = "extra" class = "description">What materials are required?</span></h3>
  <div>
    <p id = "accordion-text">
    
We work from the book DBT Skills Training Handouts and Worksheets, by Marsha M. Linehan and sometimes provide supplementary materials. You may purchase the book from Amazon. Other than something to write with and an occasional piece of scratch paper, no other materials are required!

    </p>
  </div>
</div>
</div><!-- end of intake -->
</div>	
	
<div class = "wrap">
<div id = "treatment" style="display: none">
<div id="accordion2">
	<h3><span class = "number">01</span><span id = "extra" class = "description">Can I keep my current therapist?</span></h3>
  <div>
    <p id = "accordion-text">
Absolutely! We know that a good therapeutic relationship is key to recovery. If your therapist is not familiar with DBT and you feel you need more focused DBT support, you may schedule skills-coaching sessions with one of our therapists. Please see the information about skills coaching on our Services page. 
    </p>
  </div>
	<h3><span class = "number">02</span><span id = "extra" class = "description">How long is the program?</span></h3>
  <div>
    <p id = "accordion-text">
    
DBT of Baltimore's program is 25 weeks. As long as that may seem, six months is actually a short time in which to learn so many skills. For that reason, many of our clients repeat the program to gain a deeper understanding of the skills and their application. However, one time through is usually sufficient and, remember, the more you apply yourself to the program and commit to practicing the skills in your daily life, the quicker you will learn and the more you will get from the program. 

    </p>
  </div>
</div>
</div><!-- end of treatment -->
</div>	

<div class = "wrap">
<div id = "group" style="display: none">
<div id="accordion3">
	<h3><span class = "number">01</span><span class = "description">How is DBT group different than other groups I have done?</span></h3>
  <div>
    <p id = "accordion-text">
DBT group is somewhat unlike traditional group therapy. Instead of processing thoughts, feelings and behavior, in DBT group we focus on learning skills and discussing ways to apply them. in that sense, DBT is more like a class. Group members share about themselves when reviewing homework or talking about how to apply a new skill, but the emphasis is on obtaining skills. For that reason, we require group members to be in weekly individual therapy so that they have a safe place to do more of the processing work. 
    </p>
  </div>
	<h3><span class = "number">02</span><span id = "extra" class = "description">How long are groups?</span></h3>
  <div>
    <p id = "accordion-text">
Group lasts for two hours. The first 10-15 minutes are dedicated to mindfulness practice and the remainder of first hour is spent on homework review. We take a 10-minute break between first and second hour and then the second hour is dedicated to the teaching that week's new skills. The last 5-10 minutes of group are spent orienting to the upcoming homework and if time allows, we do a short mindful "wind-down". 
    </p>
  </div>
	<h3><span class = "number">03</span><span id = "extra" class = "description">Will I have homework?</span></h3>
  <div>
    <p style="width: 100%;" id = "accordion-text">
    Homework consists of three components:
    </p>
    <ul>
      <li>Worksheets. Each week, clients are assigned one to three worksheets that correspond with the new skills taught that week. The worksheets are designed to track skill usage and help with skills application.</li>
      <li>The diary card. Clients will also fill out a daily diary card. The diary card is a two-sided page that encourages clients to mindfully pause in the evening and review their thoughts, feelings and actions for the day and track which skills they used. The diary card demonstrates over time that with practice, increasing skill usage typically leads to an improvement in thoughts, feelings and actions.</li>
      <li>Mindfulness. Clients commit to practicing ten minutes of mindfulness per day. Mindfulness is not the same as meditation, but meditation is one form of mindfulness. In DBT, clients learn a variety of ways to practice mindfulness. </li>
    </ul>
  </div>
	
	<h3><span class = "number">04</span><span class = "description">How do I get my child or loved one into DBT group?</span></h3>
  <div>
    <p id = "accordion-text">
    
Please have your loved one use our contact form to arrange for an assessment. We are happy to answer any questions you may have about our program, so you are welcome to reach out too. However, in order to schedule an assessment, we must speak with your loved one directly.

    </p>
  </div>
	
	<h3><span class = "number">05</span><span id = "extra1" class = "description">Do people ever get removed from group?</span></h3>
  <div>
    <p id = "accordion-text">
    
Clients who enroll in DBT group agree to certain guidelines regarding group participation. These guidelines serve to protect the integrity of the group as a whole and the safety and confidentiality of its members. If clients find that they cannot abide by those guidelines and it threatens the integrity of the group or the rights of other members, they may be discharged from the program. These situations are handled on a case-by-case basis with the ultimate goal of helping the client to have a positive experience.

    </p>
  </div>
	
	<h3><span class = "number">06</span><span class = "description">What happens if I am admitted to the hospital?</span></h3>
  <div>
    <p id = "accordion-text">
    
We understand that sometimes, in order to be safe, clients must untilize inpatient treatment. If you are admitted to the hospital, please have someone let us know as soon as possible. While in the hospital, you will not be charged for missed groups. If you miss more than three consecutive sessions, you will need to discontinue the module but in the meantime we will be looking forward to you being healthy enough to rejoin us for the following module. 

    </p>
  </div>
	
</div>
</div><!-- end of group -->
	
</div>	
        <?php
	return ob_get_clean();
}


function add_theme_scripts() {
  wp_enqueue_script( 'script-1', 'https://code.jquery.com/jquery-1.12.4.js', array ( 'jquery' ), 1.1, true);
  wp_enqueue_script( 'script-2', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js', array ( 'jquery' ), 1.1, true);
 
}
add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );

add_action('wp_head','hook_header');

function hook_header()
{
?>
<!--	
<script type='text/javascript' data-cfasync='false'>window.purechatApi = { l: [], t: [], on: function () { this.l.push(arguments); } }; (function () { var done = false; var script = document.createElement('script'); script.async = true; script.type = 'text/javascript'; script.src = 'https://app.purechat.com/VisitorWidget/WidgetScript'; document.getElementsByTagName('HEAD').item(0).appendChild(script); script.onreadystatechange = script.onload = function (e) { if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) { var w = new PCWidget({c: '9f94c730-8221-4e27-9002-26f3112bcf26', f: true }); done = true; } }; })();</script>
-->
<?php
}


