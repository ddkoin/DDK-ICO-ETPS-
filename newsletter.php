<?php require_once('func/config.php'); 
checkUser($main_conn);
$TITLE_PAGE="FAQ";



$CSS.=<<<css
<link href="assets/plugins/form-daterangepicker/daterangepicker-bs3.css" type="text/css" rel="stylesheet"> 
css;
$JS_FILE.=<<<js
<script src="assets/plugins/shufflejs/modernizr.custom.min.js"></script>  <!-- Dependency for Shuffle.js -->
<script src="assets/plugins/shufflejs/jquery.shuffle.min.js"></script>    <!-- Shuffle.js -->

<script src="assets/demo/demo-extras-gallery.js"></script>
<script src="assets/plugins/form-daterangepicker/daterangepicker.js"></script>
<script src="assets/plugins/form-daterangepicker/moment.min.js"></script>
<script src="js/fxerp.js?v=2"></script>
js;
$JS=<<<js

wrap_js_function();

js;
?>
<h2 class="page-title">ETPS Newsletter </h2>
 
<section class="widget">

               

                <div class="body no-margin">

<h4 ><strong>ETPS Newsletter</strong></h4>

<hr>

        

         
        
      <p>Dear all,</p>
      
      <p> we received reports that a number of users have received emails requesting for their email data or password. Please be informed that we have never sent such emails to users. Please beware of any email requesting for your personal data and ETPS account information. DO NOT reply to any of these emails unless they are from support@etpswallet.gold.</p>
      
      <p>Thank you.</p>

<hr>



<center><img class="img-responsive" src="img/DNC-AWARD-GALA-DINNER.jpg" alt="Logo"></center>
<br><br>

       <h2><b>DNC AWARD & GALA DINNER 2017</b></h2>

 <p>Since  February  2016,  the  circulation  of  DinarCoin  (DNC)  has  received  an  overwhelming  response worldwide.  Several  countries in  Southeast  Asia  are  not  left  to  participate  and  be  part  of  the technologies.  For all that have been cooperated and  participated in this innovation, everybody are now utilizing  DNC  in  the  form  of minting  & burning  process  under  the  Universal  Bitcoin  Wallet (UBW)  Platform.  This  indicates  that  the  users  of  DinarCoin  (DNC)  has  expanded rapidly  around  the world.  </p>
 
 
 
  <p>We are proud to announce that we will celebrating our<b> 2.0 Gala Dinner this coming April 2nd, 2017</b> at Magellan Sutera Harbour, Kota Kinabalu Sabah Malaysia. </p>
  
    <p>In   collaborated   with   Blockchain   INC   (Labuan),   we   will   launch   a   new   enhanced   and   hi-tech application(apps) to store DinarCoin (DNC), Bitcoin (BTC), Ethercoin (ETH) and ZCASH (ZTH) using the blockchain  technology  that  will  implement  with  VISA  DEBIT  and  NFC  DEBIT  CARD.  Other  than  that, we also will launch P2P (Peer to Peer) for sale and purchase crypto-currency among community. </p>
    
      <p>On  this  glorious  night,  there  will  be  an  award  giving  ceremony  as  an  appreciation  to  our  most  excellent product distributors for their enduring ventures and loyalties. Do not miss the chance to win the Grand Prize of Lucky Draw! Do not forget that we will invite famous local artist to enliven the historic night.</p>
      
        <p>For more details, please <a href="https://www.dinardirham.com/event/" target="_blank"><b>CLICK HERE</b>.</a> Please register before <b>26th March 2017</b> to be part of attendees. Seats are limited!  Only  1000  seats  available!    HURRY  and DO  NOT  miss  the  opportunity  to  be  a witness  in  this  historic night.</p>
        
              <p>Please be informed that the closing date for DNC Distributors Awardees will be on <b>15th March 2017.</b> </p>
              
              <p>Success does not happen in one night. The harder you work for something, the  greater you will feel when you finally achieve it.</p>
              
              <p>Your Gold, Our Technology.</p>
              
              <p>Yours Sincerely,<br> Team Management. </p>
<br>

<div style="background: #141c31;padding:10px;color: white;">
<p><b>Disclaimer:</b></p>

<p><i>Please be informed that DINARDIRHAM invited the users of ETPS program to be part of the historical night.</i> </p>

<p><i>ETPS is a marketing program to promote DinarCoin (DNC)  . ETPS is not under the same jurisdiction of DINARDIRHAM.</i></p>
     </div>   
 




<hr>

         <h2><strong>Dinardirham Events 2016</strong></h2>
 <br>
           <center><img src="img/event_flyers1.jpg" width="511" height="722" class="img-responsive"></center>
           <br>
        
       <p>The Inaugural Blockchain Conference Event in Malaysia will be held less than 12 Days. RSVP your seat NOW!</p>

<p>"The Future & Blockchain Technology Seminar" will run in the morning featuring our guest speakers from Singapore, Ukraine, United Kingdom, Pakistan and few of other experts in Blockchain Technology.</p>

<p>Don't miss this golden opportunity! You may explore the LATEST Financial Technology that has been implemented worldwide and now is brought to you by DINARDIRHAM to Malaysia. </p>
<p><center>Get Your Tickets here: <a href="http://eventdinardirham.peatix.com/" target="_blank"><button class="btn btn-default btn-xs" style="font-size:20px"><b>Register Now</b></button></a> </center></p>

<hr>
<br>
         
          <center><img src="img/event_flyers.png" width="511" height="722" class="img-responsive"></center>
         <br>

<p>Our Appreciation Night will be held in the evening with the theme called "<b><i>Black & Gold Glamorous Night</i></b>". Be among the lucky people witness the most prestigious award presentation for "<b><i>Diamond Achievers</i></b>". </p>

 


<p>You will also experiencing the best moment of your lifetime entertained by one of the famous Malaysian singer, Dayang Nurfaizah.
Be ready with your dress up to be crown as Man & Ladies "<i><b>Best Dressed Award</b></i>" or Are you lucky enough to get our Grand Prize Lucky Draw worth up to RM18,000!</p>

<p>Please take note that closing for Diamond Achievers Awardees has been calculated for this recognition as at 31st August 2016</p>

<p><center>Get Your Tickets here:  <a href="https://www.dinardirham.com/dinardirham_event/dinner/public/ticket" target="_blank"><button class="btn btn-xs btn-default" style="font-size:20px"><b>Register Now</b></button></a></center> </p>
<hr>
<p>We are welcome for Booth Registration on Day Seminar & Sponsorship PLS Log on to: <a href="https://www.dinardirham.com/dinardirham_event/dinner/public/booth#" target="_blank"><button class="btn btn-default btn-xs" style="font-size:20px"><b>Openbooth</b></button></a> <a href="https://www.dinardirham.com/dinardirham_event/dinner/public/sponsor" target="_blank"><button class="btn btn-default btn-xs" style="font-size:20px"><b>Sponsorship</b></button></a></p> 




<p>"RSVP your seat NOW! Don't Missed to be part of THIS!"<br>
For any inquiries, our hotline number - +60192551625</p>

<p>Regards,<br>
DINARDIRHAM Management Team</p>


        
        <hr>
         <h2><strong>DinarDirham First Newsletter - August 2016</strong></h2>
         
         <p>Introduction</p>
         
<p>We are proudly announce that our ETPS has been in the market for past 6 months. We have been through the obstacles smoothly to make sure the system is up-to-date for members, we have managed to foster trust between partners, experts and members.  Furthermore, Q2 of year 2016 has been a very productive year for ETPS partnership. </p>

<p>We have grown and building new partnerships and brought pre-order ETPS DNC (DinarCoin) from thousands of members in various countries such as Malaysia, Brunei, Thailand, Singapore, China and Indonesia among others. We have supported and implemented numerous events and activities. We have reached out to millions of crypto users by ensuring their ease of way to start with crypto and safer mechanism by purchase pre-order DNC (DinarCoin). We are providing them with educational and platform tools in ETPS, and lastly by getting opportunities to be the first BETA users of UBW Wallet (Universal Bitcoin Wallet) developed by DinarDirham (Gold Prime Technology HK).</p>


<p>In February, our development team has been working hard on expanding ETPS's back-office infrastructure. This helps to ensure a seamless experience across our industry leading product verticals ETPS DinarCoin Trading, MT4 Trading, ABX Trading and DinarDirham Wallet, all while ensuring that security is never compromised.</p>

<p>Furthermore, every week financial institutions across the city of world ask, "How will Blockchain change financial industry?” showing the world how open Bitcoin banking and financial services can be, is a revolutionary step towards radical transparency across the industry. This is one of the core values set out in our company's vision and drives a key part of our day-to-day activities. On the other hand, in ETPS we offered the first basic step to enter into Crypto world and participate in Blockchain industry by pre-order DNC or by using UBW Wallet to store, exchange and convert the digital assets.<p>

<p>The first ETPS newsletter in 2016 starts with the good news that ETPS (Golden Serenity Ltd) and DinarDirham (Gold Prime Technology (HK) Ltd) have signed an agreement for the use of the UBW (Universal Bitcoin Wallet) system developed by DinarDirham and all partners. UBW is a multi-assets decentralized crypto wallet platform for digital currency exchanges, facilitating client on-boarding and automated trading and payments for buying and selling digital currencies.</p>

<p>In addition, Saba Capital is one of the best and regulated "money broking" business and liquidity wealth managers in central Asia and a member of the self-regulatory organisation, the LFSA (Labuan financial services Authority).  UBW is exactly the system needed to expand into the growing B2C market for digital currencies. UBW has been in production for more than two years serving DinarDirham's own proprietary label  of DNC and GSC.</p>

<p><b>ETPS (Estimated Time Pool System)</b><br>
This new program is an innovative way for you to purchase DinarCoin and convert it into physical gold and receive a consistent monthly revenue in a safe, transparent, decentralized and trustworthy way. At this point, you have just made the first step into your financial freedom and prosperity which eventually contributing a great deal to the future of decentralized financial services and the future of Gold.</p>

<p><b>Wallet & Smart Contract</b><br>
We took more than two (2) years of development on our Decentralized Wallet, DinarCoin (DNC), GoldSmartContract (GSC) and 4.25gram physical gold, we will  launch a BETA Version on 15th August 2016. It will takes about 20 days for us to register until 4th September 2016 as to be the first batch users of our products. Full launching of our products will be held on the 4th September 2016. Hereby, we will be on the next stage for international market.</p>

<p><b>Automated Teller Machine (ATM)</b><br>
As we collaborated with few of restaurants and shops in order to popularize DinarDirham, we will open the first Bitcoin ATM in Malaysia with collaborated at Coffee Box, Prima Gombak, Selangor. This Bitcoin ATM is the first working prototype that we introduce and it will consist of Bitcoin only at the 1st stage. Our 2nd ATM coming soon will consist of DinarCoin (DNC), Ether (ETH), Bitcoin (BTC) and GoldSmartContract (GSC). There are few request and demand from various countries such as Brunei, Indonesia, Thailand and also Philippines to be located at their country. We are looking forward not just for Ethereum cooperation but also in terms of giving the best service and product globally for entire Blockchain and Bitcoin community throughout the South East Asia</p>


<p><b>Physical Gold Dinar (4.25gram)</b><br>
Our first physical Dinar will be launching on 4th September 2016 in our next coming events. It will be launched on the said date and therefore pre-order can be done by contacting your Introducer or nearest Introducer Broker (IB). We will going to have a new latest design and waiting for the launching date coming soon as we already launched our first physical gold Dinar.</p>


<p><b>DinarDirham Events</b><br>
We are organizing our first event that will be held soon consist of two (2) sessions. 1st session will be held in the morning from 9am onwards as a Seminar/Conference called it as “The Future & Blockchain Technology”. The open Seminar concept session in the morning will be engaging with our guest speakers from Singapore, Ukraine, United Kingdom, Pakistan and few of other experts in Blockchain Technology worldwide. Our 2nd session will be held in the evening specifically for “Private Appreciation Night” in order to appreciate entire community that have been registered as our ETPS investors who have been with us since Feb 2016. This private event is limited to ETPS investors and only Introducer IB can register for your tickets. You may browse further for the events website at <a href="http://www.dinardirham.com/dinardirham_event">http://www.dinardirham.com/dinardirham_event</a> and get your tickets for the “Future & Blockchain Technology” seminar and the “Private Appreciation Night” that will be open very soon.</p>



<p><b>Conclusion</b><br>
We had an awesome experience and humbly we are grateful by receiving a huge amount of interest from our community and investors around the world about our ETPS (Estimated Time Profit Sharing) product. There was a huge momentum in South East Asia and Middle East about our launch. We haven’t expected so much interest for our ETPS product. Why people are so excited about joining ETPS?  <i>The answer is: because of our digital currency that can be converted in real, physical Gold, called – DinarCoin.</i> </p>


<p>
Every DinarCoin is pegged to real, physical gold, so the risk of inflation is eliminated. We are working hard to make DinarCoin to be the perfect currency: spendable, anonymous, theft resistant, open source, non-counterfeitable, durable, inflation proof, decentralized and scarce. Our soon to be released platform will allow people to trade DinarCoin, convert it into real money (dollars, euro, yen), real physical gold or use it as payments at certain merchants. </p>

<p>
People around the world are buying DinarCoin as high potential investment, useful in many ways. DinarCoin has a big potential to become one of the most used digital currencies online around the world. It may become very useful to people every day, especially in South East Asia and Middle East because most people in Muslim countries are very familiar with dinars and there is a very well-known gold culture in South East Asia and Middle East. Dinar Coin represents a new era of global currencies.</p>

<p>
This is the beginning of a new era of global currencies and DinarCoin’s objective is to become the most used digital currency in the world. We are working very hard day and night, with all the partners around the world, to promote its usefulness and benefits globally.</p>

<p>
We see being great at something as a starting point, not an endpoint. We set ourselves goals we know we can’t reach yet, because we know that by struggling and working to meet them we can get further than we expect. Through innovation and commitment, we aim to take things that work well and improve upon them in unexpected ways.</p>

<p>
Feel free to invite your friends and family members to join our community and learn about the advantages and opportunities you get from being a loyal member of our community.  </p>


<p>Please do not hesitates to send us an email to our support team support@etpswallet.gold .Our team will be honour to  assist you for more details!</p>

<p>Yours Sincerely,<br>
With all due respect and appreciation,<br>
ETPS Management Team</p>

                </div>

            </section>
    	
<?php


 $MainContent = ob_get_contents();
 ob_end_clean();
 
 include("master.php");

?>