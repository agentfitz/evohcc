</div><!-- close maincontent -->

<div id="sidebar">
 <div id="news">
  <h3>Quick Links</h3>
  <h2>Extras</h2>
  <!-- <ul>
   <li class="evenrow"><a href="/webResources.cfm" id="webresourceslink">Web Resources</a></li>
   <li class="oddrow"><a href="/events.cfm?showAll=true" id="eventslink">Speaking Engagements</a></li>
   <li class="evenrow"><a href="/publications.cfm?showAll=true" id="publicationslink">Publications</a></li>
   <li class="oddrow"><a href="/testimonials.cfm?showAll=true" id="testimonialslink">Testimonials</a></li>
   <li class="evenrow"><a href="/contact.cfm">Get in Touch</a></li>
  </ul> -->
  <?php wp_nav_menu( array( 'theme_location' => 'secondary' ) ); ?>
 </div><!-- close news -->
 <div id="searchFormContainer">
 	<?php get_search_form(); ?>
 </div>

 <?php

  /* this is necessary since the testimonials are all inline on the testimonials page rather than
     being stored as custom-post-types, the preferred solution.
  */

  $testimonials = array(
    "Susan was very quickly able to get us on the right track.",
    "An expert in many topics related to medical practice management.",
    "Susan’s presence allowed us to focus on taking care of our patients.",
    "Helped our practice specifically in the area of contract negotiation.",
    "Accessible, knowledgeable, as well as extremely accommodating.",
    "Efficient, reliable, and a really nice person to work with.",
    "Eager to share her experiences...",
    "Proven time and again to be a most valuable resource..."
  );

  $sources = array(
    "Nola Allan, Administrator",
    "Nancy Collins, President & Publisher",
    "The Board of Raleigh Neurosurgical Clinic",
    "Lori Capps, Financial Controller",
    "Bette Corbin, Office Manager",
    "Holly FitzGerald, LCSW",
    "Susan Santaniello, COO",
    "Colleen M. O’Keefe, CMPE"
  );

  $handles = array(
    "nola",
    "nancy",
    "board",
    "lori",
    "bette",
    "holly",
    "susan",
    "colleen"
  );

  $rand = rand(0, 7);

 ?>



 <a href="/testimonials#<?php echo $handles[$rand]; ?>" id="sidebarTestimonialLink">
   <div id="sidebarTestimonialHolder" class="example-obtuse">
    <p>"<?php echo $testimonials[$rand]; ?>"</p>
   </div>
   <p id="sidebarTestimonialSpeaker">- <?php echo $sources[$rand]; ?></p>
 </a>
</div><!-- close sidebar -->
  </div><!-- close maincontentinner -->
</div><!-- close maincontentouter -->


<div id="footerouter">
 <div id="footerinner">
  <ul id="contactlist">
   <li class="first">Phone: 919.732.6832</li>
   <li>Mobile: 919.641.5373</li>
   <li><a href="mailto:schilds@evohcc.com">schilds@evohcc.com</a></li>
   <li class="last"><a href="/wp-admin">admin</a></li>
  </ul>
  <ul id="standardslist">
   <li>
     <img src="/wp-content/themes/evohcc/images/vxhtml.gif" alt="Evohcc.com Validates as xhtml standards complient" title="Evohcc.com has developed this site with full Web standards compliance" border="0">
   </li>
   <li>
     <img src="/wp-content/themes/evohcc/images/vcss.gif" alt="Evohcc.com Validates as css standards complient" title="Evohcc.com has developed this site with full Web standards compliance" border="0">
   </li>
  </ul>
 </div><!-- close footerinner -->
</div><!-- close footerouter -->

<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
  _uacct = "UA-3563632-1";
  urchinTracker();

  var highlightTestimonial = function(){
    var testimonial = window.location.hash,
        $testimonial;

    if(testimonial.length){
      $testimonial = $(testimonial);
      $testimonial.animate({ backgroundColor: "#cdd7f7" }, 800, function(){
        $testimonial.animate({ backgroundColor: "#fff" }, 800);
      });

    }
  };

  window.onhashchange = highlightTestimonial;
  $(window).bind("load", highlightTestimonial);

</script>
<a href="#colleen">hash link</a>
 <?php wp_footer(); ?>
</body>
</html>