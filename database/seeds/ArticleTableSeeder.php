<?php // app/database/seeds/ArticleTableSeeder.php


use Illuminate\Database\Seeder;

use MyNews\Article;

class ArticleTableSeeder extends Seeder {

    public function run()
    {
        DB::table('article')->delete();
        
        Article::create(array(
        		'user_id' => 1, 
        		'title' => 'Saudi Arabia: All female Brunei crew in historic flight', 
        		'body' => "<p><br></p><p class=\"story-body__introduction\">Three Royal Brunei Airlines pilots 
have made history by being the company's first all-female flight crew, 
making their first journey to Saudi Arabia, where women are not allowed 
to drive.</p><p><br></p><p>The women flew the Boeing 787 Dreamliner from Brunei to Jeddah.</p><p><br></p><p>The milestone coincided with Brunei's National Day to celebrate independence. </p><p><br></p><p>Last
 year women in Saudi Arabia cast their votes for the first time in 
municipal elections. A total of 978 women also registered as candidates.</p><p><br></p><p>They were alongside 5,938 men and had to speak behind a partition while campaigning, or be represented by a man.</p><p><br></p><p>The decision to allow women to take part was taken by the late King Abdullah and is seen as a key part of his legacy.</p><p><br></p><h2 class=\"story-body__crosshead\">'Great achievement'</h2><p><br></p><p>The flight Captain was Sharifah Czarena, assisted by Senior First Officers Sariana Nordin and Dk Nadiah Pg Khashiem.</p><p><br></p>", 
        		'photo_path' => 'http://res.cloudinary.com/pauer-projects/image/upload/v1458487192/jtczqmu2c0ttvvjl18ur.jpg', 
        		'link' => 'saudi-arabia-all-female-brunei-crew-in-historic-flight', 
        		'author_name' => 'BBC', 
        		'author_email' => '',  
        		'active' => 1
        ));
    
        Article::create(array(
        		'user_id' => 1, 
        		'title' => 'The empire the world forgot', 
        		'body' => '<p><strong>An abandoned city of ghosts<br></strong>Ruled by a dizzying 
array of kingdoms and empires over the centuries – from the Byzantines 
to the Ottomans – the city of Ani once housed many thousands of people, 
becoming a cultural hub and regional power under the medieval Bagratid 
Armenian dynasty. Today, it’s an eerie, abandoned city of ghosts that 
stands alone on a plateau in the remote highlands of northeast Turkey, 
45km away from the Turkish border city of Kars. As you walk among the 
many ruins, left to deteriorate for over 90 years, the only sound is the
 wind howling through a ravine that marks the border between Turkey and 
Armenia.</p><p><br></p><div class="inline-media inline-image">
            <div class="inline-image-wrapper">
            <a id="p03m28f7" class="responsive-image-wrapper fullsizeable" data-caption="(Credit: Linda Caldwell/Alamy)" data-caption-title="" data-is-clickable="true" href="http://ichef.bbci.co.uk/wwfeatures/1280_720/images/live/p0/3m/28/p03m28f7.jpg"><img data-fixed-width-format="" src="http://ichef.bbci.co.uk/wwfeatures/1280_720/images/live/p0/3m/28/p03m28f7.jpg" title="Ani’s city walls " alt="Ani’s city walls " class="responsive landscape" data-caption="(Credit: Linda Caldwell/Alamy)" data-caption-title="" width="" height=""></a><span id="" class="icon-wrapper gel-icon-wrapper icon-wrapper-fullscreen">
    
</span>
            
        </div>
        <div class="caption-wrapper">
            <div class="caption-lining">
                <p class="caption-text caption-body">(Credit: Linda Caldwell/Alamy)</p>
            </div>
        </div>
        </div><p><br></p><p><strong>The toll of many rulers<br></strong>Visitors
 who pass through Ani’s city walls are greeted with a panoramic view of 
ruins that span three centuries and five empires – including the 
Bagratid Armenians, Byzantines, Seljuk Turks, Georgians and Ottomans. 
The Ani plateau was ceded to Russia once the Ottoman Empire was defeated
 in the 1877-78 Russo-Turkish War. After the outbreak of World War I, 
the Ottomans fought to take back northeast Anatolia, and although they 
recaptured Ani and the surrounding area, the region was given to the 
newly formed Republic of Armenia. The site changed hands for the last 
time after the nascent Turkish Republic captured it during the 1920 
eastern offensive in the Turkish War of Independence.</p><p><br></p><div class="inline-media inline-image">
            <div class="inline-image-wrapper">
            <a id="p03m28tf" class="responsive-image-wrapper fullsizeable" data-caption="(Credit: Joseph Flaherty)" data-caption-title="" data-is-clickable="true" href="http://ichef.bbci.co.uk/wwfeatures/1280_720/images/live/p0/3m/28/p03m28tf.jpg"><img data-fixed-width-format="" src="http://ichef.bbci.co.uk/wwfeatures/1280_720/images/live/p0/3m/28/p03m28tf.jpg" title="Ancient bridge over the Akhurian River " alt="Ancient bridge over the Akhurian River " class="responsive landscape" data-caption="(Credit: Joseph Flaherty)" data-caption-title="" width="" height=""></a><span id="" class="icon-wrapper gel-icon-wrapper icon-wrapper-fullscreen">
    
</span>
            
        </div>
        <div class="caption-wrapper">
            <div class="caption-lining">
                <p class="caption-text caption-body">(Credit: Joseph Flaherty)</p>
            </div>
        </div>
        </div><p><br></p><p><strong>A hotly contested territory<br></strong>The
 ruins of an ancient bridge over the Akhurian River, which winds its way
 at the bottom of the ravine to create a natural border, are fitting 
given the vexed state of Turkish-Armenian relations. The two countries 
have long disagreed over the mass killings of Armenians that took place 
under the Ottoman Empire during World War I, and Turkey officially 
closed its land border with Armenia in 1993 in response to a territorial
 conflict between Armenia and Turkey’s ally Azerbaijan.</p><p><br></p><div class="inline-media inline-image">
            <div class="inline-image-wrapper">
            <a id="p03m295c" class="responsive-image-wrapper fullsizeable" data-caption="(Credit: Joseph Flaherty)" data-caption-title="" data-is-clickable="true" href="http://ichef.bbci.co.uk/wwfeatures/1280_720/images/live/p0/3m/29/p03m295c.jpg"><img data-fixed-width-format="" src="http://ichef.bbci.co.uk/wwfeatures/1280_720/images/live/p0/3m/29/p03m295c.jpg" title="Ruins of Ani " alt="Ruins of Ani " class="responsive landscape" data-caption="(Credit: Joseph Flaherty)" data-caption-title="" width="" height=""></a><span id="" class="icon-wrapper gel-icon-wrapper icon-wrapper-fullscreen">
    
</span>
            
        </div>
        <div class="caption-wrapper">
            <div class="caption-lining">
                <p class="caption-text caption-body">(Credit: Joseph Flaherty)</p>
            </div>
        </div>
        </div><p><br></p><p><strong>A bid to save the ruins</strong><br>Although
 the focus on Turkish-Armenian tension preoccupies most discussion of 
Ani, there’s an ongoing effort by archaeologists and activists to save 
the ruins, which have been abandoned in favour of more accessible and 
less historically contested sites from classical antiquity. Historians 
have long argued for Ani’s importance as a forgotten medieval nexus, and
 as a result, Ani is now on a tentative list for recognition as a <a href="http://whc.unesco.org/en/tentativelists/5725/">Unesco World Heritage Site</a>. With some luck and careful restoration work, which has begun in 2011, they may be able to forestall the hands of time.</p><p><br></p>', 
        		'photo_path' => 'http://res.cloudinary.com/pauer-projects/image/upload/v1458496636/ifhzbtkiem3g9wzweha4.jpg', 
        		'link' => 'the-empire-the-world-forgot', 
        		'author_name' => 'Joseph Flaherty', 
        		'author_email' => '',  
        		'active' => 1
        ));
    
        Article::create(array(
        		'user_id' => 1, 
        		'title' => 'Barack Obama in Cuba at start of historic visit', 
        		'body' => '<p><br></p><p class="story-body__introduction">President Barack Obama has arrived in Cuba for a historic visit to the island and talks with its communist leader.</p><p><br></p><p>He is the first sitting US president to visit since the 1959 revolution, which heralded decades of hostility.</p><p><br></p><p>Speaking at the reopened US embassy in Havana, he called the visit "historic". He also spent time in the old city.</p><p><br></p><p><a href="http://www.bbc.co.uk/news/topics/5e519ba4-2594-4118-a641-cdf75cd8ce46/barack-obama" class="story-body__link">Mr Obama</a>
 will meet President Raul Castro, but not retired revolutionary leader 
Fidel Castro, and the pair will discuss trade and political reform.</p><p><br></p><p>The US president emerged smiling from Air Force One with First Lady Michelle and their daughters Sasha and Malia.</p><p><br></p><p>Holding
 umbrellas, the party walked in light drizzle along a red carpet to be 
greeted by Cuban Foreign Minister Bruno Rodriguez. </p><p><br></p><p>Two hours after landing, Mr Obama greeted staff from the US embassy with the words: "It is wonderful to be here".</p><p><br></p><p>"Back
 in 1928, President [Calvin] Coolidge came on a battleship. It took him 
three days to get here, it only took me three hours. For the first time 
ever, Air Force One has landed in Cuba and this is our very first stop."</p><p><br></p>', 
        		'photo_path' => 'http://res.cloudinary.com/pauer-projects/image/upload/v1458528380/s4yuufvsiyhxyyldljg2.jpg', 
        		'link' => 'barack-obama-in-cuba-at-start-of-historic-visit', 
        		'author_name' => 'BBC', 
        		'author_email' => 'fpauer@email.com',  
        		'active' => 1
        ));
    }    

}
