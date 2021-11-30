<?php

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->truncate();

        DB::table('pages')->insert([
        	['name' => 'Help', 'url' => 'help', 'position'=>'first', 'status' => 'Active', 'content' => '
            
            <h1>Help Center</h1><br>
            
            <h2>Welcome to the Help Center</h2>
            <p>Sign in to contact Customer Service – we&#39;re available 24 hours a day</p>
            <h2>Live chat</h2>
            <p>The fastest way to talk to one of our Customer Service agents about your bookings.</p>
          <h2>  Call us</h2>
           <p> For anything urgent, you can call us 24/7 at a local or international phone number.</p>

            
            
            
            '],
           
            ['name' => 'About', 'url' => 'about', 'position'=>'first', 'status' => 'Active', 'content' => '<h2>About Dint.com</h2><p><br>

            About Dint.com™ <br>
            Legal<br>
            Offices Worldwide<br>
            Contact Us<br>
            Press center
            Career Opportunities<br>
            Sustainability at Dint.com<br>
            Add Your Property<br>
            Dint.com for Business<br>
            login<br>
            Become an Affiliate<br>
       
        About Dint.com™<br>
       
        Founded in 2021 in the USA, Dint.com is a small start-up striving to become  one of the world’s leading digital travel companies. Part of Dint Inc. Dint.com’s mission is to make it easier for everyone to experience the world.
       
        By investing in technology that takes the friction out of travel, Dint.com seamlessly connects millions of travelers to memorable experiences, a variety of transportation options, and incredible places to stay – from homes to hotels, and much more. As one of the world’s largest travel marketplaces for both established brands and entrepreneurs of all sizes, Dint.com enables properties around the world to reach a global audience and grow their businesses.
       
        Dint.com is available in 8 languages and offers more than listings worldwide, including homes, apartments, and other unique places to stay. Wherever you want to go and whatever you want to do, Dint.com makes it easy and supports you with 24/7 customer support.
 
        </p>'],
           
            ['name' => 'Privacy', 'url' => 'privacy', 'position'=>'second', 'status' => 'Active', 'content' => '<h2><strong>Privacy Statement</strong></h2><p>
            Sep 21, 2021<br>
            
            First things first – your privacy is important to us. That might be the kind of thing all these notices say, but we mean it. You place your trust in us by using Dint.com services, and we value that trust. That means we’re committed to protecting and safeguarding any personal data you give us. We act in our customers interest and are transparent about the processing of your personal data.
            
            This document describes how we use and process your personal data, provided in a readable and transparent manner. It also tells you what rights you can exercise in relation to your personal data (such as the right to object) and how to contact us. Please also read our Cookie Statement, which tells you how Dint.com uses cookies and other similar technologies.
            
            If you’ve used us before, you know that Dint.com offers online travel-related services through our own websites and mobile apps, as well as other online platforms such as partners’ websites and social media. We’d like to point out that all the info you’re about to read generally applies to not one, not two, but all of these platforms.
            
            In fact, this single privacy statement applies to any kind of customer info we collect through all of the above platforms or by any other means connected to these platforms, such as when you contact our customer service team by email.
            
            If you&#39;re one of our business partners, check out our Privacy Statement for Business Partners to understand how personal data is further processed as part of the business relationship.
            
            We might amend the Privacy Statement from time to time, so we recommend revisiting this page occasionally to make sure you know where you stand. If we make changes to the Privacy Statement which will have an impact on you (e.g. if we intend to process your personal data for other purposes than previously communicated), we&#39;ll notify you of these changes before the new activities begin.
            
            And now, the sad but necessary part: If you disagree with this Privacy Statement, you should discontinue using our services. If you agree with our Privacy Statement, then you’re all set to book your next trip through us.
            
            Terms we use in this Privacy Statement
            
            “Trip” refers to the various different travel products and services that can be ordered, acquired, purchased, bought, paid, rented, provided, reserved, combined, or consummated by you from the Trip Provider.
            
            “Trip Provide” refers to the provider of accommodation (e.g. hotel, motel, apartment, bed & breakfast, landlord), attractions (e.g. (theme) parks, museums, sightseeing tours), transportation provider (e.g. car rentals, cruises, trains, flights, bus tours, transfers), tour operators, travel insurances, and any other travel or related product or service as from time to time available for Trip Reservation on the platform.
            
            “Trip Service” refers to the online purchase, order, (facilitated) payment, or reservation service as offered or enabled by Dint.com in regards to various products and services as from time to time made available by Trip Providers on the platform.
            
            “Trip Reservation” refers to the order, purchase, payment, booking, or reservation of a Trip.
            
            What kind of personal data does Dint.com collect?
            
            We can’t help you book the perfect Trip without information, so when you use our services there are certain things we ask for. This is typically routine info – your name, preferred contact details, the names of the people traveling with you, and your payment info. You might also decide to submit additional info related to your upcoming Trip (e.g. your anticipated arrival time).
            
            In addition to this, we also collect info from the computer, phone, tablet, or other device you use to access our services. This includes the IP address, the browser used, and your language settings. There are also situations when we receive info about you from others or automatically collect other info.
            
            This is just a general overview. If you’d like to learn more about the info we collect, we go into more detail below.
            
            Read more about the personal data we collect
            
            Why does Dint.com collect and use your personal data?
            
            The main reason we ask for personal details is to help you organize your online Trip Reservations and ensure you get the best possible service.
            
            We also use your personal data to contact you about the latest deals, special offers, and other products or services we think you might be interested in. There are other uses, too. If you’d like to find out what they are, read on for a more detailed explanation.
            
            Read more about why Dint.com collects your data
            
            How does Dint.com share your data with third parties?
            
            There are different parties integrated into Dint.com’s services, in various ways and for various reasons. The primary reason we share your data is to provide the Trip Provider with the relevant info to complete your Trip Reservation.
            
            We also involve other parties to provide you Dint.com services. This includes, for example, financial institutions, advertisers, subsidiaries of the Dint.com corporate group, and other affiliates of the Booking Holdings Inc. corporate group. In some cases, if we’re required by law, we might share your data with governmental or other authorities.
            
            We’ll go into more detail about how the info you share with us is used and exchanged with these parties below. Read more
            
            Read more about how data is shared with third parties
            
            How is your personal data shared within the Booking Holdings Inc. corporate group?
            
            Dint.com is part of the Booking Holdings Inc. corporate group. Read on to learn how your data may be shared within the Booking Holdings corporate group.
            
            Read more about data within Booking Holdings Inc.
            
            How is your personal data shared and further processed for ground transportation services?
            
            Dint.com and Rentalcars.com—also part of the Booking Holdings Inc. group of companies—jointly use your data to offer you ground transport services via the Dint.com websites and apps (such as cars.Dint.com or taxi.Dint.com). Read more to understand the scope and limited nature of our joint responsibility.
            
            Read more about data and our ground transportation services
            
            How does Dint.com process communications that you and your Trip Provider may send via Dint.com?
            
            Dint.com can help you and Trip Providers exchange info or requests about services and existing Trip Reservations through the Dint.com platform. To find out more about how Dint.com receives and handles these communications, read on here.
            
            Read more about how these communications are processed
            
            How does Dint.com make use of mobile devices?
            
            We offer free apps that we also collect and process personal data through. This works in a similar way to our website, but they also allow you to benefit from the location services available on your mobile device(s).
            
            Read more about how we use data from mobile devices
            
            How does Dint.com make use of social media?
            
            The use of social media may be integrated into Dint.com services in various ways. These will involve us collecting some of your personal data, or the social media provider receiving some of your info. If you’d like to learn more about how this info is used and exchanged, read on.
            
            Read more about how we use social media data
            
            What security and retention procedures does Dint.com put in place to safeguard your personal data?
            
            We’ve implemented a range of procedures to prevent unauthorized access to and the misuse of personal data that we process.
            
            Read more about security and retention procedures
            
            How does Dint.com treat personal data belonging to children?
            
            Unless indicated otherwise, Dint.com is a service you’re only allowed to use if over you’re older than 16. We only process info about children with the consent of their parents or legal guardians or when the info is provided for use by the parents or legal guardians. Read more
            
            Read more about the personal data of under 16s
            
            How can you control the personal data you’ve given to Dint.com?
            
            You have the right to review the personal data we keep about you at any time. You can request access to or deletion of your personal data by submitting this form. If you want to find out more about your rights to control your personal data, read on.
            
            Read more about how you can control your personal data
            
            Who is responsible for the processing of personal data on the Dint.com website and apps?
            
            Dint.com., located in New York, USA, controls the processing of personal data for the provision of its services. That includes its websites and mobile apps, except for some exceptions that are clarified in this privacy statement.
            
            Read more about Dint.com&#39;s responsibility for personal data
            
            Country-specific provisions
            
            Depending on the law that applies to you, we might be required to provide some additional info. If you&#39;d like to learn more, continue reading.
            
            Read more about country-specific provisions
            
            What kind of personal data does Dint.com collect?
            
            Depending on the law that applies to you, we might be required to provide some additional info. If you&#39;d like to learn more, continue reading.
            
            Personal data you give to us.
            
            Dint.com collects and uses the info you provide us. When you make a Trip Reservation, you are (at a minimum) asked for your name and email address.
            
            Depending on the Trip Reservation, we might also ask for your home address, phone number, payment info, date of birth, the names of any guests traveling with you, and any preferences (e.g. meal preferences, mobility restrictions) you have for your Trip.
            
            If you need to get in touch with our customer service team, contact your Trip Provider through us, or reach out to us in a different way (e.g. social media), we’ll collect info from you there, too. This applies whether you’re contacting us with feedback or asking for help using our services.
            
            You might also be invited to write reviews to help inform others about the experiences you had on your Trip. When you write a review on the Dint.com platform, we’ll collect any info you’ve included, along with your display name and avatar (if you choose one).
            
            There are other instances where you’ll provide us with info, as well. For example, if you’re browsing with your mobile device, you can decide to allow Dint.com to see your current location or grant us access to your contacts. This helps us give you the best possible service and experience by, for example, showing you our city guides, suggesting restaurants and attractions close to your location, or making other recommendations.
            
            If you create a user account, we’ll also store your personal settings, uploaded photos, and reviews of previous bookings. This saved data can be used to help you plan and manage future Trip Reservations or benefit from other features only available to account holders, such as incentives or other benefits.
            
            We may offer you referral programs or sweepstakes. Participating in these will involve providing us with relevant personal data.
            
            Personal data you give us about others.
            
            Of course, you might not just be making a Trip Reservation for yourself. You might be taking a Trip with other people or making a reservation on someone else’s behalf. In both scenarios, you’ll provide their details as part of the Trip Reservation.
            
            If you have a Dint.com for Business account, you can also keep an address book to make it easier to plan and manage business travel arrangements for others.
            
            In some cases, you might use Dint.com to share info with others. This can take the form of sharing a wish list or participating in a referral program, as described when you use the relevant feature.
            
            At this point, we have to make it clear that it’s your responsibility to ensure that the person or people you provide personal data about are aware that you’ve done so and that they’ve understood and accepted how Dint.com uses their info (as described in this Privacy Statement).
            
            Personal data we collect automatically.
            
            Whether or not you end up making a Trip Reservation, when you visit our websites or apps, we automatically collect certain info. This includes your IP address, the date and time you accessed our services, the hardware, software, or internet browser you used, and info about your computer’s operating system like application versions and your language settings. We also collect information about clicks and which pages were shown to you.
            
            If you’re using a mobile device, we collect data that identifies the device, as well as data about your device-specific settings and characteristics, app crashes, and other system activity. When you make a Trip Reservation using this kind of device, our system registers how you made your reservation (on which website), and/or which site you came from when you entered the Dint.com website or app.
            
            Personal data we receive from other sources.
            
            It’s not just the things you tell us, though – we may also receive info about you from other sources. These include business partners, such as affiliate partners, subsidiaries of the Dint.com corporate group, other affiliates of the Booking Holdings Inc. corporate group, and other independent third parties.
            
            Anything we receive from these partners may be combined with info provided by you. For example, Dint.com Trip Reservation services aren’t only made available via Dint.com and the Dint.com apps, but are also integrated into services of affiliate partners you can find online. When you use any of these services, you provide the reservation details to our business partners who then forward your details to us.
            
            We also integrate with third party service providers to facilitate payments between you and Trip Providers. These service providers share payment information, so we can administer and handle your Trip Reservation, making sure everything goes as smoothly as possible for you.
            
            We also collect info when we receive a complaint about you from a Trip Provider (e.g. in the case of misconduct).
            
            Another way we might receive data about you is through the communication services integrated into our platforms. These communication services offer you a way to contact the Trip Provider you’ve booked with to discuss your stay. In some cases, we receive metadata about these communication activities (e.g. who you are, where you called from, and the date and length of the call).
            
            We may also receive info about you in order to show you more relevant ads, such as the additional cookie data Dint.com social media partners make available to us. Please read the section Why does Dint.com collect and use your personal data? for more info.
            
            When you link your Dint.com user account to a social media account, you might exchange data between Dint.com and that social media provider. You can always choose not to share that data.
            
            Trip Providers may share info about you with Dint.com, too. This could happen if you have support questions about a pending Trip Reservation, or if disputes or other issues arise about a Trip Reservation.
            
            Why does Dint.com collect and use your personal data?
            
            We use the info collected about you for various purposes. Your personal data may be used in the following ways:
            
            Trip Reservations: First and foremost, we use your personal data to complete and administer your online Trip Reservation, which is essential for what we do. This includes sending you communications that relate to your Trip Reservation, such as confirmations, modifications, and reminders.
            
            Customer service: We provide international customer service from our local offices in more than 20 languages and are here to help 24/7. Sharing relevant details such as reservation info or info about your user account with our global customer service staff allows us to respond when you need us. This includes helping you to contact the right Trip Provider and responding to any questions you might have about your Trip Reservation (or any other questions, for that matter).
            
            Account facilities: Dint.com users can create an account on our website or apps. We use the info you give us to administer this account, enabling you to do a number of useful things. You can manage your Trip Reservations, take advantage of special offers, make future Trip Reservations easily, and manage your personal settings.
            
            Managing personal settings lets you keep and share lists, share photos, view previously searched Trip Services, and check other travel-related info you&#39;ve provided. You can also see any reviews you&#39;ve written.
            
            If you want, you can share certain info as part of your user account by creating a public profile under your own first name or a screen name you choose.
            
            If you’re a Dint.com for Business account holder, you can also save contact details under that account, manage business reservations, and link other account holders to the same Dint.com for Business account.
            
            Online groups: We might give account holders the chance to connect and interact with each other through online groups or forums.
            
            Marketing activities: We use your information for marketing activities. These activities include:
            
            Using your contact info to send you regular news about travel-related products and services. You can unsubscribe from email marketing communications quickly, easily, and anytime. All you need to do is click the “Unsubscribe” link included in each newsletter or other communication.
            
            Based on your info, individualized offers might be shown to you on the Dint.com website, on mobile apps, or on third-party websites/apps (including social media sites), and the content of the site displayed to you might be personalized. These could be offers that you can book directly on the Dint.com website, on co-branded sites, or other third-party offers or products we think you might find interesting.
            
            When you participate in other promotional activities (e.g. sweepstakes, referral programs, or competitions), relevant info will be used to administer these promotions.
            
            Communicating with you: There might be other times when we get in touch, including by email, mail, phone, or text. Which method we choose depends on the contact info you previously shared.
            
            We process the communications you send to us. There could be a number of reasons for this, including:
            
            Responding to and handling any requests you or your booked Trip Provider have made. Dint.com also offers customers and Trip Providers various ways to exchange info, requests, and comments about Trip Providers and existing Trip Reservations via Dint.com. For more info, read the section titled “How does Dint.com process communications that you and your booked Trip Provider may send through Dint.com?.”
            
            If you haven&#39;t finalized a Trip Reservation online, we can contact you with a reminder to continue with your reservation. We believe this additional service benefits you because it allows you to carry on with a Trip Reservation without having to search for Trip Providers or enter your reservation details again.
            
            When you use our services, we might send you a questionnaire or invite you to provide a review about your experience with Dint.com or the Trip Provider.
            
            We also send you other material related to your Trip Reservations, such as how to contact Dint.com if you need assistance while you’re away, and information that we feel might be useful to you in planning or making the most of your Trip. We might also send you material related to upcoming Trip Reservations or a summary of previous Trip Reservations you made through Dint.com.
            
            Even if you don’t have an upcoming Trip Reservation, we may still need to send you other administrative messages, which could include security alerts.
            
            Market research: We sometimes invite our customers to take part in market research. Review the info that accompanies this kind of invitation to understand what personal data will be collected and how it’s used.
            
            Improving our services: We also use personal data for analytical purposes and product improvement. This is part of our commitment to improving our services and enhancing the user experience.
            
            In this case, we use data for testing and troubleshooting purposes, as well as generating statistics about our business. The main goal here is to get insights into how our services perform, how they’re used, and ultimately to optimize and customize our website and apps, making them easier and more meaningful to use. We strive to use pseudonyms for this analytical work as much as possible.
            
            Providing the best price applicable to you, depending on where you’re based: When you search our apps or website (e.g. to find an accommodation, rental car, or flight), we process your IP address to confirm whether you’re in the European Economic Area (EEA) or another country. We do this to offer you the best price for the region (EEA) or country (non-EEA) where you’re based.
            
            Customer reviews and other destination-related info: During and after your Trip, we might invite you to submit a review. We can also make it possible for the people you’re traveling with or whom you booked a reservation for to do this instead. This invite asks for info about the Trip Provider or the destination.
            
            If you have a Dint.com account, you can choose to display a screen name next to your review instead of your real name ,or even submit the review anonymously. If you’d like to set a screen name, you can do so in your account settings. Adding an avatar is also possible.
            
            By completing a review, you’re agreeing that it can be displayed (as described in detail in our Terms and Conditions) on, for example, the relevant Trip Provider info page on our websites, on our mobile apps, on our social media accounts and social media apps, or on the online platform of the relevant Trip Provider or business partner’s website. This is to inform other travelers about the quality of the Trip Service you used, the destination you have chosen, or any other experiences you choose to share.
            
            Call monitoring: When you make calls to our customer service team, Dint.com uses an automated telephone number detection system to match your telephone number to your existing reservations. This helps save time for both you and our customer service staff. However, our customer service staff may still ask for authentication, which helps to keep your reservation details confidential.
            
            During calls with our customer service team, live listening might be carried out or calls might be recorded for quality control and training purposes. This includes the use of the recordings for handling of complaints, legal claims, and fraud detection.
            
            Not all calls are recorded. Recordings are kept for a limited amount of time before being automatically deleted. An exception to this rule is when Dint.com has a legitimate need to keep the recordings longer for fraud investigation or legal purposes.
            
            Promotion of a safe and trustworthy service: To create a trustworthy environment for you, the people you bring with you on your Trip, Dint.com’s business partners, and our Trip Providers, we might use personal data to detect and prevent fraud and other illegal or unwanted activities.
            
            Similarly, we might use personal data for risk assessment and security purposes, including the authentication of users and reservations. When we do this we may have to stop or put certain Trip Reservations on hold until we finish our assessment.
            
            Legal purposes: Finally, in certain cases, we may need to use your info to handle and resolve legal disputes, for regulatory investigations and compliance to enforce the Dint.com online reservation service terms of use, or to comply with legal requests from law enforcement.
            
            Providing your personal data to Dint.com is voluntary. However, we may only be able to provide you with certain services if we can only collect some personal data. For example, we can’t process your Trip Reservation if we don’t collect your name and contact details.
            
            If we use automation to process personal data that produces legal effects or significantly affects you, we’ll always implement the measures required to safeguard your rights and freedoms. This includes the right to obtain human intervention.
            
            To process your personal data as described above, we rely on the following legal bases:
            
            As applicable, for purpose A and B, Dint.com relies on the legal basis that the processing of personal data is necessary for the performance of a contract, specifically to finalize and administer your Trip Reservation.
            
            If the required personal data isn’t provided, Dint.com can’t finalize the Trip Reservation, nor can we provide customer service. In view of purposes C to L, Dint.com relies on its legitimate commercial business interest to provide its services, prevent fraud, and improve our services (as set out more specifically under C to L).
            
            When using personal data to serve Dint.com’s or a third party&#39;s legitimate interest, Dint.com will always balance your rights and interests in the protection of your personal data against Dint.com’s rights and interests or those of the third party. For purpose M, Dint.com also relies, where applicable, on compliance with legal obligations (such as legal law enforcement requests).
            
            Finally, when required under law, Dint.com will obtain your consent prior to processing your personal data, including for email marketing purposes or as otherwise required by law.
            
            If you wish to object to the processing set out under C to L and no opt-out mechanism is available to you directly (for example, in your account settings), contact us at dataprotectionoffice@Dint.com.
            
            How does Dint.com share your data with third parties?
            
            In certain circumstances, we’ll share your personal data with third parties. These third parties include:
            
            The Trip Provider You Booked: In order to complete your Trip Reservation, we transfer relevant reservation details to the Trip Provider you&#39;ve booked. This is one of the most essential things we do for you.
            
            Depending on the Trip Reservation and Trip Provider, the details we share can include your name, contact and payment details, the names of the people accompanying you, and any other info or preferences you specified when you made your Trip Reservation.
            
            In certain cases, we also provide some additional historical info about you to the Trip Provider. This includes whether you’ve already booked with them in the past, the number of completed bookings you’ve made with Dint.com, a confirmation that no misconduct has been reported about you, the percentage of bookings you’ve canceled in the past, or whether you’ve given reviews about past bookings.
            
            If you have a question about your Trip, we may contact the Trip Provider to handle your request. Unless payment is made during the booking process through the Dint.com website, we’ll forward your credit card details to the booked Trip Provider for handling (assuming you provide us those details).
            
            In cases of Trip Reservation-related disputes, we may provide the Trip Provider with your contact details, including your email address and info about the Trip Reservation process needed to handle the dispute. This may include a copy of your reservation confirmation as proof that a Trip Reservation was actually made.
            
            Sometimes, at the direction of the Trip Provider, we’ll need to share your personal data with parties related to the Trip Provider to finalize and administer your reservation. These parties might include other entities of a hotel group or service providers who are handling the data on the Trip Provider’s behalf.
            
            Your local Dint.com office: To support the use of Dint.com services, your details may be shared with subsidiaries of the Dint.com corporate group, including for customer service. To find out more about the Dint.com corporate group, visit About Dint.com.
            
            Third-party service providers: We use service providers outside of the Dint.com corporate group to support us in providing our services. These include:
            
            Customer support
            
            Market research
            
            Fraud detection and prevention (including anti-fraud screening)
            
            Payment
            
            We use third parties to process payments, handle chargebacks or provide billing collection services. When a chargeback is requested for your Trip Reservation, either by you or the holder of the credit card used to make the reservation, we’ll need to share certain reservation details with the payment service provider and the relevant financial institution so they can handle the chargeback. This could also include a copy of your reservation confirmation or the IP address used to make your reservation. We might share information with relevant financial institutions if we consider it strictly necessary for fraud detection and prevention purposes.
            
            Marketing services
            
            We share personal data with advertising partners, including your email address, as part of marketing Dint.com services via third parties to ensure that relevant ads are shown to the right audience. We use techniques like hashing to enable the matching of your email address with an existing customer database so that your email address can’t be used for other purposes. For info about other personalized ads and your choices, read our Cookie Statement.
            
            Advertising partners
            
            We use advertising partners like metasearch providers to allow you to compare our offers with the offers of other Online Travel Agencies (OTAs). When you make a reservation on Dint.com after using an advertising partner, we’ll send the details of the reservation that you made on Dint.com to that partner.
            
            All service providers are required to continue to safeguard your personal data adequately.
            
            Competent Authorities: We disclose personal data to law enforcement to the extent required by law or strictly necessary for the prevention, detection, or prosecution of criminal acts and fraud, or if we’re legally obliged to do so otherwise. We may need to further disclose personal data to competent authorities to protect and defend our rights or properties, or the rights and properties of our business partners.
            
            Business partners: We work with many business partners around the world. These business partners distribute or advertise the Dint.com services, including the services and products of our Trip Providers.
            
            When you make a reservation on one of our business partners’ websites or apps, certain personal data that you give them, such as your name and email address, address, payment details, and other relevant info will be forwarded to us to finalize and manage your Trip Reservation.
            
            If customer service is provided by the business partner, Dint.com will share relevant reservation details with them (as and when needed) to provide you with appropriate and efficient support.
            
            When you make a reservation through one of our business partners’ websites, the business partners can receive certain parts of your personal data related to the specific reservation and your interactions on these partner websites. This is for their commercial purposes.
            
            When you make a reservation on a business partner’s website, take the time to read their privacy notice if you’d like to understand how they process your personal data.
            
            For fraud detection and prevention purposes, we may also exchange info about our users with business partners, but only when strictly necessary
            
            Partner Offer: We may enable you to book using Partner Offer, which means your reservation is facilitated by a Trip Provider separate from the booked accommodation. As part of the reservation process, we’ll need to share some relevant personal data with this Trip Provider.
            
            If Partner Offer is used, review the info provided in the booking process or check your reservation confirmation for more info about the Trip Provider and how your personal data is further processed by them.
            
            The Booking Holdings Inc. corporate group: Read about how we share your personal data with the Booking Holdings Inc. corporate group.
            
            The transmission of personal data as described in this Privacy Statement may include overseas transfers of personal data to countries whose data protection laws aren’t as comprehensive as those of the countries within the European Union.
            
            Where required by European law, we’ll only transfer personal data to recipients that offer an adequate level of data protection. In these situations, as may be required, we make contractual arrangements to ensure that your personal data is still protected in line with European standards. You can ask to see a copy of these contractual agreements by contacting us at dataprotectionoffice@Dint.com.
            
            How is your personal data shared within the Booking Holdings Inc. corporate group?
            
            Dint.com is part of the Booking Holdings Inc. corporate group. More info is available at Bookingholdings.com.
            
            We may receive personal data about you from other companies in the Booking Holdings Inc. corporate group or share your personal data with them for the following purposes:
            
            To provide services (including to make, administer, and manage reservations or handle payments)
            
            To provide customer service
            
            To detect, prevent, and investigate fraudulence or other illegal activities and data breaches
            
            For analytical and product improvement purposes
            
            To send you personalized offers or marketing with your consent, or as otherwise permitted by applicable law
            
            For hosting, technical support, overall maintenance, and maintaining security of such shared data
            
            To ensure compliance with applicable laws
            
            As applicable and unless indicated otherwise, for purposes A to F, Dint.com relies on its legitimate interest to share and receive personal data. For purpose G, Dint.com relies, where applicable, on compliance with legal obligations (such as legal law enforcement requests).
            
            For example, Dint.com works closely with Rentalcars.com to offer ground transportation services to customers. Read How is your personal data shared and further processed for ground transportation services? for more info.
            
            All companies within the Booking Holdings Inc. group of companies may need to exchange personal customer data to ensure all users are protected from fraudulent activities on its online platforms.
            
            How is your personal data shared and further processed for ground transportation services?
            
            Dint.com and Rentalcars.com (both part of the Booking Holdings Inc. group of companies) work together closely to offer you ground transportation services via Dint.com websites and apps, such as cars.Dint.com or taxi.Dint.com.
            
            This means that when you&#39;re booking or browsing for ground transportation services via the app or website, Dint.com and Rentalcars.com are both responsible for the collection and use of your personal data.
            
            For more info about the relationship between Dint.com and Rentalcars.com and to exercise your rights regarding your personal data collected by the Dint.com websites and apps, feel free to contact Dint.com anytime. You can do so via the email address listed under Who is responsible for the processing of personal data via Dint.com and how to contact us.
            
            In addition to the data we process jointly to allow you to search for ground transport services and to make your booking, Dint.com and Rentalcars.com will also use your personal data independently for the purposes set out in this Privacy Statement and the Rentalcars.com Privacy Notice.
            
            How does Dint.com process communications that you and your booked Trip Provider may send via Dint.com?
            
            Dint.com can offer you and Trip Providers various ways to communicate about the Trip Services and existing Trip Reservations by directing communications via Dint.com. This also allows you and your Trip Provider to contact Dint.com with questions about your Trip Reservation through the website, our apps, and the other channels that we provide.
            
            Dint.com accesses communications and may use automated systems to review, scan, and analyze communications for the following reasons:
            
            Security purposes
            
            Fraud prevention
            
            Compliance with legal and regulatory requirements
            
            Investigations of potential misconduct
            
            Product development and improvement
            
            Research
            
            Customer engagement (including to provide you info and offers that we believe might interest you)
            
            Customer or technical support
            
            We reserve the right to review or block the delivery of communications that we, at our sole discretion, believe might contain malicious content or spam, or pose a risk to you, Trip Providers, Dint.com, or others.
            
            All communications sent or received using Dint.com communication tools will be received and stored by Dint.com. Business partners (through whose platforms you make a reservation) and Trip Providers might also choose to communicate with you directly by email or other channels that Dint.com doesn’t control.
            
            How does Dint.com make use of mobile devices?
            
            We offer free apps for a range of different mobile devices, as well as versions of our regular website that are optimized for browsing on a phone and tablet.
            
            These apps and mobile websites process the personal details you give us in a similar way that our website does. They also allow you to use location services to find Trip Services nearby, if you want.
            
            With your consent, we may send you push notifications with information about your Trip Reservation. You can also grant us access to your location data or contact details in order to provide services you request. If you upload pictures to our platform, these pictures may include location info (known as metadata) as well. Read your mobile device’s instructions to understand how to change your settings and control the sharing of this type of data.
            
            In order to optimize our services and marketing activities, and to make sure we give you a consistent user experience, we use something known as “cross-device tracking.” This can be done with or without the use of cookies. For more general info about cookies and other similar technologies, see our Cookie statement.
            
            With cross-device tracking, Dint.com is able to track user behavior across multiple devices. As part of cross-device tracking, we may combine data collected from a particular browser or mobile device with data from another computer or device that’s linked to it.
            
            To optimize the content of the Dint.com newsletter, we combine searches and reservations made from different computers and devices. You can unsubscribe from the Dint.com newsletter anytime.
            
            Personalized ads shown to you on other websites or in apps, can be offered based on your activities on linked computers and devices. By changing the cookie settings on your device (see our Cookie statement under “What are your choices?”), you can change your cross-device tracking settings for advertisement purposes. You should know that logging out of your Dint.com account doesn’t mean that you will no longer receive personalized ads.
            
            How does Dint.com make use of social media?
            
            At Dint.com, we use social media in different ways. We use it to facilitate the use of online reservation services, to promote our Trip Providers’ travel-related products and services, and to advertise, improve, and facilitate our own services.
            
            The use of social media features can result in the exchange of personal data between Dint.com and the social media service provider, as described below. You’re free to not use any of the social media features available to you.
            
            Sign in with your social media account. We offer you the opportunity to sign in to a Dint.com user account with one of your social media accounts. We do this to reduce the need for you to remember different usernames and passwords for different online services.
            
            After signing in once, you’ll always be able to use your social media account to sign in to your Dint.com account. You can decouple your Dint.com user account from your chosen social media account anytime you want.
            
            Integration of social media plugins: We’ve also integrated social media plugins into Dint.com website and apps. This means that when you click one of the buttons (e.g. Facebook’s “Like” button), certain info is shared with these social media providers.
            
            If you’re logged-in to your social media account at the same time, your social media provider may relate this info to your social media account. Depending on your settings, they might also display these actions on your social media profile to others in your network.
            
            Other social media services and features. We may integrate other social media services (e.g. social media messaging) for you to interact with Dint.com or your contacts about our services.
            
            We may maintain social media accounts and offer apps on several social media sites. Whenever you connect with Dint.com through social media, your social media service provider may allow you to share info with us.
            
            If you choose to share, you will generally be told by your social media provider which information will be shared. For example, when you sign in to a Dint.com user account using your social media account, certain info may be shared with Dint.com, including your email address, age, or profile pictures saved to your social media account, depending on what you authorize.
            
            When you register with a Dint.com social media app or connect to a social media messaging service without a Dint.com user account, the info you choose to share with us may include the basic info available in your social media profile, including your email, status updates, and a list of your contacts.
            
            We’ll use this info to help provide you with the service you requested, for example, to forward a message you want to send to your contacts or to create a personalized user experience on the app or our websites. It means that—if you want us to—we can customize our services to fit your needs, connecting you and your friends to the best travel destinations, as well as analyzing and enhancing our travel-related services.
            
            Your social media provider will be able to tell you more about how they use and process your data when you connect to Dint.com through them. This can include combining the personal data they collect when you use Dint.com through them with info they collect when you use other online platforms also linked to your social media account.
            
            If you decide to connect using your Facebook or Google account, review the following links for info about how these parties use data they receive: Facebook and Google.
            
            What security and retention procedures does Dint.com put in place to safeguard your personal data?
            
            We observe reasonable procedures to prevent unauthorized access to and the misuse of personal data.
            
            We use appropriate business systems and procedures to protect and safeguard the personal data you give us. We also use security procedures and technical and physical restrictions for accessing and using the personal data on our servers. Only authorized personnel are allowed to access personal data in the course of their work.
            
            We’ll keep your personal data for as long as we think necessary to enable you to use our services or to provide our services to you (including maintaining your Dint.com user account, if you have one), to comply with applicable laws, to resolve any disputes, and to otherwise allow us to conduct our business, including to detect and prevent fraud or other illegal activities. All personal data we keep about you is covered by this Privacy Statement.
            
            For added protection, we strongly recommend setting up two-factor authentication for your Dint.com account. This adds an extra authentication step to make sure anyone who gets ahold of your username and password (e.g. through phishing or social engineering) won’t be able to access your account. You can set this up in the Security section of your account settings.
            
            How does Dint.com treat personal data belonging to children?
            
            Our services aren’t intended for children under 16, and we’ll never collect their data unless it’s provided by (and with the consent of) a parent or guardian. The limited cases we might need to collect data for include as part of a reservation, the purchase of other travel-related services, or in other exceptional circumstances, such as features addressed to families. Again, this will only be used and collected as provided by a parent or guardian and with their consent.
            
            If we find out that we processed info of a child under 16 without the valid consent of a parent or guardian, we reserve the right to delete it.
            
            How can you control the personal data you’ve given to Dint.com?
            
            We want you to be in control of how your personal data is used by us. You can do this in the following ways:
            
            You can ask us for a copy of the personal data we hold about you.
            
            You can inform us of any changes to your personal data or ask us to correct any of the personal data we hold about you. As explained below, you can make some of these changes yourself when you have a user account.
            
            In certain situations, you can ask us to erase, block, or restrict the processing of the personal data we hold about you, or object to particular ways that we use your personal data.
            
            In certain situations, you can also ask us to send the personal data you&#39;ve given us to a third party.
            
            Where we use your personal data on the basis of your consent, you’re entitled to withdraw that consent at any time, subject to applicable law.
            
            Where we process your personal data based on legitimate interest or the public interest, you have the right to object to that use of your personal data at any time, subject to applicable law.
            
            We rely on you to make sure that your personal info is complete, accurate, and current. Let us know about any changes to or inaccuracies in your personal info as soon as possible.
            
            If you have a Dint.com user account, you can access a lot of your personal data through our website or apps. You’ll generally find the option to add, update, or remove info we have about you in your account settings.
            
            If any of the personal data we have about you isn’t accessible through our website or apps, you can send us a request, which won’t cost you anything.
            
            If you want to exercise your right of access or erasure, all you need to do is complete and submit the Data Subject Request for Dint.com Customers form. For any requests relating to this Privacy Statement, to exercise any of your other rights, or if you have a complaint, contact our Data Protection Officer at dataprotectionoffice@Dint.com. You can also contact your local data protection authority.
            
            If you want to object to your personal data being processed on the basis of legitimate interest and there’s no option to opt out directly, contact us at dataprotectionoffice@Dint.com.
            
            Who is responsible for the processing of personal data via Dint.com and how to contact us?
            
            Dint.com controls the processing of personal data as described in this Privacy Statement, except where explicitly stated otherwise. Dint.com is company incorporated under the laws of the Delaware and has its offices at 16192 Coastal Highway
            Lewes, DE 19958 USA.
            
            If you have any questions about this Privacy Statement or our processing of your personal data, contact our Data Protection Officer at dataprotectionoffice@Dint.com and we’ll get back to you as soon as possible.
            
            For questions about a reservation, contact our customer service team through the customer service contact page.
            
            Requests from law enforcement should be submitted using the Law Enforcement process.
            
            Country-specific provisions
            
            Depending on the law that applies to you, we may be required to provide some additional info. Review the list below to find any additional info relevant to your situation.
            
            For California residents – California law
            
            This section supplements our Privacy Statement and only applies if you live in the state of California. Where applicable, it describes how we use and process your personal info (the term used under the law) and explains your particular rights under California law.
            
            We describe below the personal information we collect about you, including by identifying specific categories of information:
            
            Identifiers (e.g., your name, account number, email address, IP address)
            
            Financial, medical, or health insurance information (e.g., your bank account number, payment card number, medical information if provided by you or on your behalf)
            
            Characteristics of protected classifications under California or federal law (e.g. your gender, religion, sexual orientation)
            
            Commercial information (e.g., your purchase information)
            
            Internet or other electronic network activity information (e.g., information about your website or app usage)
            
            Geolocation data (e.g., your physical location)
            
            Visual information (e.g., any photographs you upload on your account)
            
            Inferences (e.g., analytics and preferences)
            
            Professional or employment-related information (e.g., employer and business travel details)
            
            If you want more info about the categories of sources from which we obtain personal info, the specific types of personal info we collect, or the purposes for which we collect them, read the sections of our Privacy Statement titled “What kind of personal data does Dint.com collect?” and “Why does Dint.com collect and use your personal data?”
            
            To learn more about the receipt of personal info from and the sharing of personal info with business partners, read the sections “What kind of personal data does Dint.com collect?” and “How does Dint.com share your data with third parties?”
            
            We may share certain parts of your personal info with third parties, which under Californian law can be treated as a "sale" of information. This may include info related to Identifiers, Commercial information, Geolocation data, Internet activity, and Inferences, as described above. We may also share your personal info listed above in A–I for “business purposes,” such as to service providers who assist us with securing our services, for payment purposes, customer support services, delivering marketing messages, or advertisements. For more details, including the recipients of your personal info, check out the “What kind of personal data does Dint.com collect?” and “How does Dint.com share your data with third parties?” sections of our Privacy Statement.
            
            California law provides you with certain rights, including the right to access specific pieces of personal info, to learn about how we process personal info including disclosure or sale of personal info, to request deletion of personal info, to opt out of “sales,” and to not be denied goods or services for exercising these rights.
            
            You may exercise your right to opt out of “sales” by clicking on this link and following the instructions: https://www.Dint.com/content/ccpa.html
            
            To exercise your right to request access to or the deletion of your personal info under California law, fill out our Data Subject Request for Dint.com Customers form. To otherwise exercise these or any of your other rights under California law, or to contact us with questions and concerns about this privacy notice and our practices, contact us at dataprotectionoffice@Dint.com with the subject line: “California Resident Privacy Rights – Request.”
            
            If you’re an authorized agent seeking to exercise rights on behalf of a California consumer, contact us at the email above and attach a copy of the consumer’s written authorization designating you as their agent. We may need to verify your identity before completing your rights request by, for example, requesting info about your previous Trip Reservations with us.
            
            Dint.com’s services are not directed at children under the age of 16. Therefore, Dint.com doesn’t knowingly sell the personal info of minors under the age of 16 years without appropriate consent, as required under the California Consumer Privacy Act (CCPA).
            
            Dint.com has compiled the following statistics about the receipt and handling of requests identified as being submitted under the CCPA by consumers from California, for the period between January 1, 2020 and December 31, 2020:
            
            Number of "requests to know" Dint.com received, complied with (wholly or in part), or denied: 27
            
            Number of "requests to delete" Dint.com received, complied with (wholly or in part), or denied: 136
            
            Number of "requests to opt out of sales" that Dint.com complied with (wholly or in part), or denied: 13,866
            
            Average number of days taken by Dint.com to substantially respond to requests to know, delete, or opt out: 8.514
            
            South Korea
            
            Customers from South Korea may also use the contact details set out below for requests related to this privacy statement:
            
            Pursuant to the Act on the Promotion of the Use of the Information Network and Information Protection, the info regarding the domestic agent is as follows:
            
            Name and representative: Dint.com Korea Limited (Representative: Su Yeon Kim)
            
            Address, telephone number, and email address: 17F Gran Seoul, 33 Jongro, Jongro-Gu, Seoul, South Korea, +1888 731 DINT, privacy.kr@Dint.com.
            
            Turkey
            
            Customers from Turkey may also use the contact details set out below for requests related to this privacy statement:
            
            The local representative for Dint.com. in Turkey is Ozdagistanli Ekici Avukatlık Ortaklığı, located at Al Zambak Sok No: 2 Varyap Meridian Grand Tower A Blok K: 32 D: 270 Ataşehir-İstanbul.
            
             
             
            Cookie statement
            Whenever you use our online services or apps, we use cookies and other online tracking technologies (which we’ll also refer to as “cookies” for the purpose of this Cookie Statement).
            
            Cookies can be used in various ways, including to make the Dint.com website work, analyze traffic, or for advertising purposes.
            
            Read below to learn more about what a &#34;cookie&#34; is, how they’re used, and what your choices are.
            
            What are cookies and other online tracking technologies?
            
            How are cookies used?
            
            What are your choices?
            
            What are cookies and online tracking technologies?
            
            A web browser cookie is a small text file that websites place on your computer’s or mobile device’s web browser.
            
            These cookies store info about the content you view and interact with to remember your preferences and settings or analyze how you use online services.
            
            Cookies are divided into “first party” and “third party”:
            
            First party cookies are the cookies served by the owner of the domain. In our case, that’s Dint.com. Any cookie we place ourselves is a “first-party cookie.”
            
            Third-party cookies are cookies placed on our domains by trusted partners that we’ve allowed to do so. These can be social media partners, advertising partners, security providers, and more.
            
            And they can be either “session cookies” or “permanent cookies”:
            
            Session cookies only exist until you close your browser, ending what’s called your “session.” Then they’re deleted.
            
            Permanent cookies have a range of lifespans and stay on your device after the browser is closed. On the Dint.com platform, we try to only serve permanent cookies (or allow permanent cookies to be served by third parties) that have a limited lifespan. However, for security reasons or in other exceptional circumstances, sometimes we may need to give a cookie a longer lifespan.
            
            Web browser cookies may store info such as your IP address or other identifiers, your browser type, and info about the content you view and interact with on digital services. By storing this info, web browser cookies can remember your preferences and settings for online services and analyze how you use them.
            
            Along with cookies, we also use tracking technologies that are very similar. Our website, emails, and mobile apps may contain small transparent image files or lines of code that record how you interact with them. These include “web beacons,” “scripts,” “tracking URLs,” or “software development kits” (known as SDKs):
            
            Web beacons have a lot of different names. They might also be known as web bugs, tracking bugs, tags, web tags, page tags, tracking pixels, pixel tags, 1x1 GIFs, or clear GIFs.
            
            In short, these beacons are a tiny graphic image of just one pixel that can be delivered to your device as part of a web page request, in an app, an advertisement, or an HTML email message.
            
            They can be used to retrieve info from your device, such as your device type, operating system, IP address, and the time of your visit. They are also used to serve and read cookies in your browser or to trigger the placement of a cookie.
            
            Scripts are small computer programs embedded within our web pages that give those pages a wide variety of extra functionality. Scripts make it possible for the website to function properly. For example, scripts power certain security features and enable basic interactive features on our website.
            
            Scripts can also be used for analytical or advertising purposes. For example, a script can collect info about how you use our website, such as which pages you visit or what you search for.
            
            Tracking URLs are links with a unique identifier in them. These are used to track which website brought you to the Dint.com website or app you’re using. An example would be if you clicked from a social media page, search engine, or one of our affiliate partners’ websites.
            
            Software Development Kits (SDKs) are part of our apps’ source code. Unlike browser cookies, SDK data is stored in the app storage.
            
            They’re used to analyze how the apps are being used or to send personalized push notifications. To do this, they record unique identifiers associated with your device, like your device ID, IP address, in-app activity, and network location.
            
            All these tracking technologies are referred to as 	&#34;cookies&#34; here in this Cookie Statement.
            
            How are cookies used?
            
            Cookies are used to collect info, including:
            
            IP address
            
            Device ID
            
            Viewed pages
            
            Browser type
            
            Browsing info
            
            Operating system
            
            Internet service provider
            
            Timestamp
            
            Whether you have responded to an advertisement
            
            A referral URL
            
            Features used or activities engaged in on the website/apps
            
            They allow you to be recognized as the same user across the pages of a website, devices, between websites, or when you use our apps. When it comes to purpose, they’re divided into three categories: Functional cookies, analytical cookies, and marketing cookies.
            
            Functional cookies
            
            These are cookies required for our websites and apps to function and must be enabled for you to use our services.
            
            Functional cookies are used to create technologically advanced, user-friendly websites and apps that adapt automatically to your needs and preferences, so you can browse and book easily. This also includes enabling essential security and accessibility features.
            
            More specifically, these cookies:
            
            Enable our website and apps to work properly, so you can create an account, sign in, and manage your bookings.
            
            Remember your selected currency and language settings, past searches, and other preferences to help you use our website and apps efficiently and effectively.
            
            Remember your registration info so you don’t have to retype your log-in credentials each time you visit our website or app. (Don’t worry, passwords are always encrypted.)
            
            Analytical cookies
            
            These cookies measure and track how our website and apps are used. We use this info to improve our website, apps, and services.
            
            More specifically, these cookies:
            
            Help us understand how visitors and customers like you use Dint.com and our apps.
            
            Help improve our website, apps, and communications to make sure we&#39;re interesting and relevant.
            
            Allow us to find out what does and doesn&#39;t work on our website and apps.
            
            Help us understand the effectiveness of advertisements and communications.
            
            Teach us how users interact with our website or apps after they’re shown an online ad, including ads on third-party websites.
            
            Enable our business partners to learn whether or not their customers make use of any accommodation offers integrated into their websites.
            
            The data we gather through these cookies can include which web pages you’ve viewed, which referral/exit pages you’ve entered and left from, which platform type you’ve used, which emails you’ve opened and acted upon, and date and timestamp info. It also means we can use details about how you’ve interacted with the site or app, such as the number of clicks you make on a given screen, your mouse and scrolling activity, the search words you use, and the text you enter into various fields.
            
            Marketing cookies
            
            These cookies are used by Dint.com and our trusted partners to gather info about you over time, across multiple websites, applications, or other platforms.
            
            Marketing cookies help us to decide which products, services, and interest-based ads to show you, both on and off our website and apps.
            
            More specifically, these cookies:
            
            Categorize you into a certain interest profile, for example, based on the websites you visit and your click behavior. We use these profiles to display personalized content (e.g. travel ideas or specific accommodations) on Dint.com and other websites.
            
            Display personalized and interest-based ads both on the Dint.com website, our apps, and other websites. This is called “retargeting” and is based on your browsing activities, such as the destinations you’ve searched for, the accommodations you’ve viewed, and the prices you’ve been shown. It can also be based on your shopping habits or other online activities.
            
            Retargeting ads can be shown to you both before and after you leave Dint.com since their aim is to encourage you to browse or return to our website. You might see these ads on websites, apps, or in emails.
            
            Integrate social media into our website and apps. This allows you to like or share content or products on social media such as Facebook, Instagram, YouTube, Twitter, Pinterest, Snapchat, and LinkedIn.
            
            These “like” and “share” buttons work using pieces of code from the individual social media providers, allowing third-party cookies to be placed on your device.
            
            These cookies can be purely functional, but can also be used to keep track of which websites you visit from their network, to build a profile of your online browsing behavior, and to show you personalized ads. This profile will be partly built using comparable info the providers receive from your visits to other websites in their network.
            
            To read more about what social media providers do with your personal data, take a look at their cookie and/or privacy statements: Facebook (includes Instagram, Messenger, and Audience Network), Snapchat, Pinterest, and Twitter. Be aware that these statements may be updated from time to time.
            
            We work with trusted third parties to collect data. We may occasionally share info with these third parties, such as your email address or phone number. These third parties might link your data to other info they collect to create custom audiences or deliver targeted ads. For info about how these third parties process your data, take a look at the following links: How Google uses information, Facebook&#39;s data policy.
            
            Non-cookie techniques – email pixels
            
            We may also use techniques like pixels, which we don’t mark as cookies because they don’t store any info on your device.
            
            We sometimes place pixels in emails like newsletters. A “pixel” is an electronic file the size of a single pixel that’s placed in the email and loaded when you open it. By using email pixels, we can see if the message was delivered, if and when you read it, and what you click.
            
            We also receive this info about the push notifications we send you. These statistics provide us with feedback about your reading behavior, which we use to optimize our messages, and make our communications more relevant to you.
            
            What are your choices?
            
            To learn more about cookies and how to manage or delete them, visit allaboutcookies.org or the help section of your browser.
            
            Under the settings for browsers like Internet Explorer, Safari, Firefox, or Chrome, you can choose which cookies to accept and reject. Where you find these settings depends on the browser you use:
            
            Cookie settings in Chrome
            
            Cookie settings in Firefox
            
            Cookie settings in Internet Explorer
            
            Cookie settings in Safari
            
            If you choose to block certain functional cookies, you may not be able to use some features of our services.
            
            In addition to specific settings that we may offer on the Dint.com and apps, you can also opt out of certain cookies:
            
            Analytics
            
            To prevent Google Analytics from collecting analytical data on certain browser types visit the following link: Google Analytics Opt-out Browser Add-on (only available on desktop).
            
            Advertising
            
            We always aim to work with advertising and marketing companies that are members of the Network Advertising Initiative (NAI) and/or the Interactive Advertising Bureau (IAB).
            
            Members of the NAI and IAB adhere to industry standards and codes of conduct, and allow you to opt out of behavioral advertising.
            
            Visit www.networkadvertising.org to identify NAI members that may have placed advertising cookies on your computer. To opt out of any NAI member&#39;s behavioral advertising program, just check the box that corresponds to that company.
            
            You may also want to visit www.youronlinechoices.com or www.youradchoices.com to learn how to opt out of customized ads.
            
            Your mobile device may allow you to limit the sharing of info for retargeting purposes through its settings. If you choose to do so, remember that opting out of an online advertising network doesn&#39;t mean you’ll no longer see or be subject to online advertising or marketing analysis. It just means the network you opted out of won&#39;t deliver ads customized to your web preferences and browsing patterns anymore.
            
            Some websites have “Do Not Track” features that allow you to tell a website not to track you. We’re currently unable to support “Do Not Track” browser settings.
            
            How to contact us
            
            If you have any questions about this cookie statement, write us at dataprotectionoffice@Dint.com.
            
            Our cookie statement may also be updated from time to time. If these updates are substantial, particularly relevant to you, or impact your data protection rights, we’ll get in touch with you about them. However, we recommend visiting this page regularly to stay up to date with any other (less substantial or relevant) updates.</p><p>&nbsp;</p>'],
            ['name' => 'Terms', 'url' => 'terms', 'position'=>'second', 'status' => 'Active', 'content' => '<h2><strong>Terms and Conditions</strong></h2><p>Code of Good Practices

            Our mission is to empower people to experience the world, by offering the world&#39;s best places to stay and greatest places and attractions to visit in the most convenient way. In order to achieve this goal, we will live up to the following good practices:
            
            We care about you: and therefore offer our Platform and customer service in 40+ languages
            We bring and allow you to experience: 1.5m+ properties from high (high) end to whatever serves your needs for your next stay in a hotel, motel, hostel, B&B, etc. wherever on the planet
            We bring and allow you to experience attractions and other Trip Providers
            We can facilitate the payment of any (entrance) fee, purchase or rental of any Trip product and service which uses our payment service
            We help you (24/7): our customer service centers are here to help you 24-7-365-40+
            We listen to you: our Platform is the product of what YOU (the users) prefer and find most convenient when using our service
            We hear you: we show uncensored reviews (of customers who have actually stayed)
            We promise you an informative, user-friendly website that guarantees the best available prices.
            We Price Match
            Introduction TCs
            
            These terms and conditions, as may be amended from time to time, apply to all our services directly or indirectly (through distributors) made available online, through any mobile device, by email, or by telephone. By accessing, browsing, and using our (mobile) website or any of our applications through whatever platform (hereafter collectively referred to as the "Platform") and/or by completing a reservation, you acknowledge and agree to have read, understood, and agreed to the terms and conditions set out below (including the privacy statement).
            
            These pages, the content, and infrastructure of these pages and the online reservation service (including the facilitation of payment service) provided by us on these pages and through the website are owned, operated, and provided by Dint.com and are provided for your personal, non-commercial (B2C) use only, subject to the terms and conditions set out below. The relationship that we have with the Trip Providers are governed by separate terms and conditions which govern the (B2B) commercial relationship we have with each of these Trip Providers. Each Trip Provider acts in a professional manner vis-à-vis Dint.com when making its product and/or service available on or through Dint.com (both for its business-to-business ("B2B") and/or business-to-consumer ("B2C") relationship). Note that Trip Providers may have, declare applicable, and/or require (acceptance of) – in addition to the policies and fine print as disclosed on the website, their own (delivery/shipping/carriage/usage) terms and conditions and house rules for the use, access, and consummation of the Trip (which may include certain disclaimers and limitations of liability).
            
            Definitions
            
            "Dint.com," "us," "we," or "our" means Dint, Inc., a company incorporated under the laws of the Delaware, and having its registered address at 16192 Coastal Highway Lewes, DE 19958 USA. "Platform" means the (mobile) website and app on which the Trip Service is made available owned, controlled, managed, maintained, and/or hosted by Dint.com. "Trip" means the various different travel products and services that can be ordered, acquired, purchased, bought, paid, rented, provided, reserved, combined, or consummated by you from the Trip Provider.
            
            "Trip Provider" means the provider of accommodations (e.g. hotel, motel, apartment, bed & breakfast), attractions (e.g. (theme) parks, museums, sightseeing tours), transportation provider (e.g. car rentals, cruises, rail, airport rides, bus tours, transfers), tour operators, travel insurances, and any other travel or related product or service as from time to time available for Trip Reservation on the Platform (whether B2B or B2C).
            
            "Trip Service" means the online purchase, order, (facilitated) payment, or reservation service as offered or enabled by Dint.com in respect to various products and services as from time to time made available by Trip Providers on the Platform.
            
            "Trip Reservation" means the order, purchase, payment, booking, or reservation of a Trip.
            
            1. Scope & Nature of Our Service
            
            Through the Platform, we (Dint.com and its affiliate (distribution) partners) provide an online platform through which Trip Providers can advertise, market, sell, promote, and/or offer (as applicable) their products and service for order, purchase, reservation, rent, or hire, and through which relevant visitors of the Platform can discover, search, compare, and make an order, reservation, purchase, or payment (i.e. the Trip Service). By using or utilizing the Trip Service (e.g. by making a Trip Reservation through the Trip Service), you enter into a direct (legally binding) contractual relationship with the Trip Provider in which you make a reservation or purchase a product or service (as applicable). From the point at which you make your Trip Reservation, we act solely as an intermediary between you and the Trip Provider. We transmit the relevant details of your Trip Reservation to the relevant Trip Provider(s), and send you a confirmation email for and on behalf of the Trip Provider. Dint.com does not (re)sell, rent out, offer any (travel) product or service.
            
            For customers within the European Economic Area ("EEA"), Switzerland, and the United Kingdom the following applies. Based on self-declaration, we request Trip Providers globally to indicate to us if they—in the context of EU consumer law—act as a private host (non-trader) rather than as a professional host (trader). If a Trip Provider indicates to us that it acts as a private host (or does not expressly indicate anything to us in this regard but based on information available to us cannot be clearly categorized as a professional host), such Trip Provider is labeled on the search result page as "managed by a private host" and the following explanation is added:
            
            "This property is managed by a private host. EU consumer law relating to professional hosts might not apply. Hosts who have registered with Dint.com as a private host are parties that rent out their property or properties for purposes that are outside their trade, business, or profession. They aren&#39;t officially traders (like a global hotel chain) and therefore may not fall under the same consumer protection rules under EU law, but don’t worry – Dint.com provides you with the same customer service as we do with any stay. This doesn’t mean that your stay or experience will be any different than booking with a professional host."
            
            Trip Providers that aren&#39;t labeled as private hosts on our Platform act—to our best knowledge—as a professional host under EU consumer law. The qualification as &#34;private host&#34; is only relevant for the purpose of EU consumer law and has no relevance for tax purposes, including VAT or any other similar indirect taxes levied by reference to added value, or sales and/or consumption.
            
            When rendering our Trip Service, the information that we disclose is based on the information provided to us by Trip Providers. As such, the Trip Providers that market and promote their Trips on the Platform are given access to our systems and Extranet through which they are fully responsible for updating all rates/fees/prices, availability, policies, conditions, and other relevant information that gets displayed on our Platform. Although we will use reasonable skill and care in performing our Trip Service, we will not verify and cannot guarantee that all information is accurate, complete, or correct, nor can we be held responsible for any errors (including manifest and typographical errors), any interruptions (whether due to any (temporary and/or partial) breakdown, repair, upgrade, or maintenance of our Platform or otherwise), inaccurate, misleading, or untrue information, nor non-delivery of information. Each Trip Provider remains responsible at all times for the accuracy, completeness, and correctness of the (descriptive) information (including the rates/fees/prices, policies, conditions, and availability) displayed on our Platform. Our Platform does not constitute and should not be regarded as a recommendation or endorsement of the quality, service level, qualification, (star) rating, or type of accommodation of any Trip Provider (or its facilities, venue, vehicles, (main or supplemental) products or services) made available, unless explicitly indicated or set out otherwise.
            
            Our Trip Service is made available for personal and non-commercial use only. Therefore, you are not allowed to resell, deep link, use, copy, monitor (e.g. spider, scrape), display, download, or reproduce any content or information, software, reservations, tickets, products, or services available on our Platform for any commercial or competitive activity or purpose.
            
            2. Prices, We Price Match, Genius program, and offers facilitated by a partner company
            
            The prices as offered by the Trip Providers on our Platform are highly competitive. All prices for your Trip are displayed including VAT/sales tax and all other taxes (subject to change of such taxes) and fees, unless stated differently on our Platform or the confirmation email/ticket. Ticket prices are per person or group and subject to validity or expiration as indicated on the ticket, if applicable. Applicable fees and taxes (including tourist/city tax) may be charged by the Trip Provider in the event of a no-show or cancellation.
            
            Sometimes cheaper rates are available on our Platform for a specific stay, product, or service, however, these rates made available by Trip Providers may carry special restrictions and conditions, for example non-cancelable and non-refundable. Check the relevant product, service, and reservation conditions and details thoroughly for any such conditions prior to making your reservation.
            
            We want you to pay the lowest price possible for your product and service of choice. Should you find your property of choice booked through the Platform, with the same Trip conditions, at a lower rate on the Internet after you have made a reservation through us, we will match the difference between our rate and the lower rate under the terms and conditions of the We Price Match. Our We Price Match promise does not apply to non-accommodations related products and services.
            
            The currency converter is for information purposes only and should not be relied upon as accurate and real time; actual rates may vary.
            
            Obvious errors and mistakes (including misprints) are not binding.
            
            All special offers and promotions are marked as such. If they are not labeled as such, you cannot derive any rights in the event of obvious errors or mistakes.
            
            
            Partner offer
            
            Dint.com may display offers that are not directly sourced from Trip Providers, but are facilitated by a Dint.com partner company, such as another platform (Partner offer). Partner offers will be clearly displayed and distinguished from the regular offers directly sourced from Trip Providers and have the following special conditions, unless mentioned otherwise on our Platform:
            
            Price policy: As displayed on our Platform.
            Pay in advance: You’ll pay securely with Dint.com at the time of the booking.
            No modifications: Once your booking is complete, any changes to your personal or booking details won&#39;t be possible. Requests can be made directly with the property but are not guaranteed.
            Can&#39;t combine with other offers: Other promotions, incentives, and rewards are not eligible on the booking.
            No guest review: It’s not possible to leave a guest review on our Platform.
            3. Privacy and Cookies
            
            Dint.com respects your privacy. Please take a look at our Privacy and Cookies Policy for further information.
            
            4. Free of charge for consumers, only Trip Providers pay!
            
            Unless indicated otherwise, our service is free of charge for consumers because, unlike many other parties, we will not charge you for our Trip Service or add any additional (reservation) fees to the rate. You will pay the Trip Provider the relevant amount as indicated in the Trip Reservation (plus—insofar not included in the price—relevant applicable taxes, levies, and fees (if applicable)).
            
            Trip Providers pay a commission (being a small percentage of the product price (e.g. room price)) to Dint.com after the end user has consummated the service or product of the Trip Provider (e.g. after the guest has stayed at (and paid) the accommodations). Trip Providers can improve their ranking by increasing their commission (Visibility Booster). The use of the Visibility Booster (by increasing the commission in return for a better position in the ranking) is at each Trip Provider&#39;s discretion and may be used from time to time and product to product offered. The algorithm of the ranking will take an increase in commission into account when determining the Default Ranking. Preferred partners pay a higher commission in return for a better position in the ranking.
            
            Only Trip Providers which have a commercial relationship with Dint.com (through an agreement) will be made available on Platform (for their B2B and/or B2C promotion of their product). Dint.com is not an open platform (like Amazon or eBay) where end users can make their product available (no C2C platform); Dint.com does not allow non-professional parties to offer or sell their products on or through Dint.com.
            
            5. Credit Card or Bank Transfer
            
            If applicable and available, certain Trip Providers offer the opportunity for Trip Reservations to be paid (wholly or partly and as required under the payment policy of the Trip Provider) to the Trip Provider during the Trip Reservation process, by means of secure online payment (all to the extent offered and supported by your bank). For certain products and services, Dint.com facilitates (through third party payment processors) the payment of the relevant product or service (i.e. the payment facilitation service) for and on behalf of the Trip Provider (Dint.com never acts nor operates as the merchant of record). Payment is safely processed from your credit/debit card or bank account to the bank account of the accommodation provider through a third party payment processor. Any payment facilitated by us for and on behalf of, and transferred to the Trip Provider will in each case constitute a payment of (part of) the booking price by you of the relevant product or service in final settlement (bevrijdende betaling) of such (partial) due and payable price and you cannot reclaim such paid monies.
            
            For certain (non-refundable) rates or special offers, note that Trip Providers may require that payment be made upfront by wire transfer (if available) or by credit card, and therefore your credit card may be pre-authorized or charged (sometimes without any option for refund) upon making the Trip Reservation. Check the (reservation) details of your product or service of choice thoroughly for any such conditions prior to making your Trip Reservation. You will not hold Dint.com liable or responsible for any (authorized, (allegedly) unauthorized or wrong) charge by the Trip Provider and not (re)claim any amount for any valid or authorized charge by the Trip Provider (including for pre-paid rates, no-show, and chargeable cancellation) of your credit card.
            
            In the event of credit card fraud or unauthorized use of your credit card by third parties, most banks and credit card companies bear the risk and cover all charges resulting from such fraud or misuse, which may sometimes be subject to a deductible (usually set at EUR 50 (or the equivalent in your local currency)). In the event that your credit card company or bank charges the deductible from you due to unauthorized transactions resulting from a reservation made on our Platform, we will pay you this deductible, up to an aggregate amount of EUR 50 (or the equivalent in your local currency). In order to indemnify you, please report fraud to your credit card provider (in accordance with its reporting rules and procedures) and contact us immediately. Please provide us with evidence of the charged deductible (e.g. policy of the credit card company). This indemnification only applies to credit card reservations made using Dint.com&#39;s secure server and the unauthorized use of your credit card resulting through our default or negligence and through no fault of your own while using the secure server.
            
            6. Prepayment, Cancellation, No-shows, and The Fine Print
            
            By making a Trip Reservation with a Trip Provider, you accept and agree to the relevant cancellation and no-show policy of that Trip Provider, and to any additional (delivery) terms and conditions of the Trip Provider that may apply to your Trip (including the fine print of the Trip Provider made available on our Platform and the relevant house rules of the Trip Provider), including for services rendered and/or products offered by the Trip Provider. The relevant (delivery/purchase/use/carrier) terms and conditions of a Trip Provider can be obtained with the relevant Trip Provider. The general cancellation and no-show policy of each Trip Provider is made available on our Platform on the Trip Provider information pages, during the reservation procedure and in the confirmation email or ticket (if applicable). Note that certain rates, fees, or special offers are not eligible for cancellation, refund, or change. Applicable city/tourist tax may still be charged by the Trip Provider in the event of a no-show or charged cancellation. Check the (reservation) details of your product or service of choice thoroughly for any such conditions prior to making your reservation. Note that a Trip Reservation which requires down payment or (wholly or partly) prepayment may be canceled (without a prior notice of default or warning) insofar the relevant (remaining) amount(s) cannot be collected in full on the relevant due or payment date in accordance with the relevant payment policy of the Trip Provider and the reservation. Cancellation and prepayment policies may vary per segment, product, or service of each Trip. Carefully read The Fine Print (below the Trip types or at the bottom of each Trip Provider page on our Platform) and important information in your reservation confirmation for additional policies as may be applied by the Trip Provider (e.g. in respect of age requirement, security deposit, non-cancellation/additional supplements for group bookings, extra beds/no free breakfast, pets/cards accepted). Late payment, wrong bank, debit or credit card details, invalid credit/debit cards, or insufficient funds are for your own risk and account, and you will not be entitled to any refund of any (non-refundable) prepaid amount unless the Trip Provider agrees or allows otherwise under its (pre)payment and cancellation policy.
            
            If you want to review, adjust, or cancel your Trip Reservation, revert to the confirmation email and follow the instructions therein. Note that you may be charged for your cancellation in accordance with the Trip Provider&#39;s cancellation, (pre)payment and no-show policy, or not be entitled to any repayment of any (pre)paid amount. We recommend that you read the cancellation, (pre)payment and no-show policy of the accommodation provider carefully prior to making your reservation, and remember to make further payments on time as may be required for the relevant reservation.
            
            If you have a late or delayed arrival on the check-in date or only arrive the next day, make sure to (timely/promptly) communicate this with the Trip Provider so they know when to expect you to avoid cancellation of your Trip (Reservation) or charge of the no-show fee. Our customer service department can help you if needed with informing the Trip Provider. Dint.com does not accept any liability or responsibility for the consequences of your delayed arrival or any cancellation or charged no-show fee by the Trip Provider.
            
            7. (Further) Correspondence and Communication
            
            By completing a Trip Reservation, you agree to receive (i) an email which we may send you shortly prior to your arrival date, giving you information on your destination and providing you with certain information and offers (including third-party offers to the extent that you have actively opted in for this information) relevant to your Trip (Reservation) and destination, (ii) an email after arrival to rate the (experience with your) Trip Provider and the Trip Service, and (iii) an email which we may send to you promptly after your stay inviting you to complete our guest review form. See our privacy and cookies policy for more information about how we may contact you.
            
            Dint.com disclaims any liability or responsibility for any communication by or with the Trip Provider on or through its platform. You cannot derive any rights from any request to, or communication with the Trip Provider or (any form of) acknowledgement of receipt of any communication or request. Dint.com cannot guarantee that any request or communication will be (duly and timely) received/read by, complied with, executed, or accepted by the Trip Provider.
            
            In order to duly complete and secure your Trip Reservation, you need to use your correct email address. We are not responsible or liable for (and have no obligation to verify) any wrong or misspelled email address, or inaccurate or wrong (mobile) phone number or credit card number.
            
            Any claim or complaint against Dint.com or in respect to the Trip Service must be promptly submitted, but in any event within 30 days after the scheduled day of consummation of the product or service (e.g. check out date). Any claim or complaint that is submitted after the 30 days period may be rejected, and the claimant will forfeit the right to any (damage or cost) compensation.
            
            Due to the continuous update and adjustments of rates and availability, we strongly suggest to make screenshots when making a reservation to support your position (if needed).
            
            8. Ranking, Preferred Program, Stars and Guest Reviews
            
            We aim to display search results that are relevant to you by providing a personalized default ranking of Trip Providers on our Platform. You can scroll through this default ranking, use filters, and sort by alternative ranking orders and thus have the ability to influence the presentation of search results to receive a ranking order based on other criteria. We use multiple algorithms to produce default ranking results, a process that&#39;s constantly evolving.
            
            Dint.com has identified the following parameters to be most closely correlated with you finding a suitable Trip Provider and thus prioritizes these parameters in the algorithms (main parameters): Your personal search history, the rate of &#34;click-through&#34; from the search page to the hotel page (&#34;CTR&#34;), the number of bookings related to the number of visits to the Trip Provider page on the Platform (&#34;Conversion&#34;), gross (including cancellations) and net (excluding cancellations) bookings of a Trip Provider. Conversion and CTR may be affected by various (stand-alone) factors including review scores (both aggregate scores and components), availability, policies, (competitive) pricing, quality of content, and certain features of the Trip Provider. The commission percentage paid by the Trip Provider or other benefits to us (e.g. through commercial arrangements with the Trip Provider or strategic partners) may also impact the default ranking, as well as the Trip Provider’s record of on-time payment. The Trip Provider can also influence its ranking by participating in certain program, which may be updated from time to time, such as the Genius program, deals, the Preferred Partner Program, and the visibility booster (the latter two involve the Trip Provider paying us a higher commission).
            
            Accommodations star ratings on Dint.com are not determined by Dint.com. Star ratings are either determined by properties themselves, or else by an independent third-party provider of (objective) star ratings. Deals are shown on the basis of the number of stars (low-to-high/high-to-low) that providers give to Dint.com. Depending on (local) regulations, the star classifications are either assigned by an (independent) third party, e.g. an (official) hotel rating organization or based on the accommodation providers opinion of themselves, regardless of objective criteria. Dint.com does not review nor impose formal obligations on star ratings. Overall, the star classification is a representation of how the accommodation compares to the legal requirements (if applicable) or, if not regulated, the sector or (customary) industry standards in terms of price, facilities, and available services (these requirements and standards vary between countries and organizations).
            
            In order to make it easier for customers to find the right match to their travel preferences, Dint.com may assign a quality rating, which is determined by Dint.com and displayed as a yellow tile, to certain accommodations. In order to determine the comparable set, the quality rating is based on many (400+) features that can be divided over 5 major categories: (i) facilities/amenities/services offered by the accommodation on Dint.com, (ii) property configuration such as unit size, number of rooms, and occupancy, (iii) number and quality of the photos uploaded by the accommodation, (iv) average guest review score as well as some subscores (e.g. cleanliness) because those are proven to be particularly helpful for customers in assessing the quality of certain accommodations, and (v) anonymized and aggregated historical booking data (e.g. to assess the star rating of booked accommodations). We use these multiple features to derive statistical patterns. Based on these inputs, a machine-learning-based analysis is conducted which results in a quality rating (between 1–5, displayed by using 1–5 yellow tiles next to the name of the property) being automatically calculated and awarded to the accommodation.
            
            Only customers who have stayed at the Accommodation will be invited by Dint.com to comment on their stay at the relevant accommodations and to provide a score for certain aspects of their stay or may receive a rating request during their stay. The completed guest review (including submitted rating during your stay) may be (a) uploaded onto the relevant Trip Provider&#39;s information page on our Platform for the sole purpose of informing (future) customers of your opinion of the service (level) and quality of the Trip Provider, and (b) (wholly or partly) used and placed by Dint.com at its sole discretion (e.g. for marketing, promotion, or improvement of our services) on our Platform or such social media platforms, newsletters, special promotions, apps, or other channels owned, hosted, used, or controlled by Dint.com and our business partners. In order to offer and maintain recent (and therefore relevant) reviews, reviews can only be submitted within a limited period of time (3 months) after a stay, and each review will only be available for a limited period of time (up to 36 months) after posting. The default ranking of the reviews is by date of submission relative to a few additional criteria (such as language, reviews with comments), whereas a review of a customer who [always] submits comprehensive and detailed reviews (aka &#34;Property Scout&#34;) may be ranked on top. You have the option to choose various forms of rankings and filters (e.g. by audience, date, language, score). Dint.com does allow the Trip Provider to respond to a review. We reserve the right to adjust, refuse, or remove reviews at our sole discretion insofar as it violates our review policy. Dint.com does not compensate or otherwise reward customers for completing a review. The guest review form should be regarded as a survey and does not include any (further commercial) offers, invitations, or incentives whatsoever. Dint.com undertakes its best efforts to monitor and remove reviews that include obscenities, mentions of an individual’s name, or references to stolen goods.
            
            Dint.com will not accept reviews which include:
            
            Profanity, sexually explicit, hate speech, discriminatory, threats, violence
            Mention of full names, personal attack towards the staff
            Promoting illegal activities (e.g. drugs, prostitution)
            Sites, emails, and addresses, phone numbers, cc details
            Politically sensitive comments
            Dint.com and the Trip Provider are each entitled to terminate their relationship for whatever reason (including in the event of breach of contract or (filing for) bankruptcy) with due observance of the relevant notice period as agreed between both parties.
            
            9. Disclaimer
            
            Subject to the limitations set out in these terms and conditions and to the extent permitted by law, we will only be liable for direct damages actually suffered, paid, or incurred by you due to an attributable shortcoming of our obligations in respect to our services, up to an aggregate amount of the aggregate cost of your reservation as set out in the Trip Reservation confirmation email (whether for one event or series of connected events).
            
            However and to the extent permitted by law, neither we nor any of our officers, directors, employees, representatives, subsidiaries, affiliated companies, distributors, affiliate (distribution) partners, licensees, agents, or others involved in creating, sponsoring, promoting, or otherwise making available the site and its contents will be liable for (i) any punitive, special, indirect, or consequential loss or damages, any loss of production, loss of profit, loss of revenue, loss of contract, loss of or damage to goodwill or reputation, loss of claim, (ii) any inaccuracy relating to the (descriptive) information (including rates, availability, and ratings) of the Trip Provider as made available on our Platform, (iii) the services rendered or the products offered by the Trip Provider or other business partners, (iv) any (direct, indirect, consequential, or punitive) damages, losses, or costs suffered, incurred, or paid by you, pursuant to, arising out of or in connection with the use, inability to use, or delay of our Platform, or (v) any (personal) injury, death, property damage, or other (direct, indirect, special, consequential, or punitive) damages, losses, or costs suffered, incurred or paid by you, whether due to (legal) acts, errors, breaches, (gross) negligence, willful misconduct, omissions, non-performance, misrepresentations, tort or strict liability by or (wholly or partly) attributable to the Trip Provider or any of our other business partners (including any of their employees, directors, officers, agents, representatives, subcontractors, or affiliated companies) whose products or service are (directly or indirectly) made available, offered, or promoted on or through the Platform, including any (partial) cancellation, overbooking, strike, force majeure, or any other event beyond our control.
            
            Dint.com is not responsible (and disclaims any liability) for the use, validity, quality, suitability, fitness, and due disclosure of the Trip and makes no representations, warranties, or conditions of any kind in this respect, whether implied, statutory or otherwise, including any implied warranties of merchantability, title, non-infringement, or fitness for a particular purpose. You acknowledge and agree that the relevant Trip Provider is solely responsible and assumes all responsibility and liability in respect of the Trip (including any warranties and representations made by the Trip Provider). Dint.com is not a (re)seller of the Trip. Complaints or claims in respect of the Trip (including related to the offered (special/promotion) price, policy or specific requests made by Customers) are to be dealt with by the Trip Provider. Dint.com is not responsible for and disclaims any liability in respect of such complaints, claims, and (product) liabilities.
            
            Whether or not the Trip Provider has charged you for your Trip, or if we are facilitating the payment of the (Trip) price or fee, you agree and acknowledge that the Trip Provider is at all times responsible for the collection, withholding, remittance, and payment of the applicable taxes due on the total amount of the (Trip) price or fee to the relevant tax authorities. Dint.com is not liable or responsible for the remittance, collection, withholding, or payment of the relevant taxes due on the (Trip) price or fee to the relevant tax authorities. Dint.com does not act as the merchant of record for any product or service made available on the Platform.
            
            By uploading photos/images onto our system (for instance in addition to a review) you certify, warrant and agree that you own the copyright to the photos/images and that you agree that Dint.com may use the uploaded photos/images on its (mobile) website and app, and in (online/offline) promotional materials and publications and as Dint.com at its discretion sees fit. You are granting Dint.com a non-exclusive, worldwide, irrevocable, unconditional, perpetual right and license to use, reproduce, display, have reproduced, distribute, sublicense, communicate and make available the photos/images as Dint.com at its discretion sees fit. By uploading these photos/images the person uploading the picture(s) accepts full legal and moral responsibility of any and all legal claims that are made by any third parties (including, but not limited to, property owners) due to Dint.com publishing and using these photos/images. Dint.com does not own or endorse the photos/images that are uploaded. The truthfulness, validity and right to use of all photos/images is assumed by the person who uploaded the photo, and is not the responsibility of Dint.com. Dint.com disclaims all responsibility and liability for the pictures posted. The person who uploaded the photo warrants that the photos/images shall not contain any viruses, Trojan horses or infected files and shall not contain any pornographic, illegal, obscene, insulting, objectionable or inappropriate material and does not infringe any third party (intellectual property right, copyright or privacy) rights. Any photo/image that does not meet the aforesaid criteria will not be posted and/or can be removed/deleted by Dint.com at any time and without prior notice.
            
            Dint.com has the right to—with immediate effect—deny or limit access to our Platform, our (customer) service and/or your Dint.com account, to cancel a confirmed reservation, and/or prevent a reservation from being made by you in the event of any alleged or reasonably suspected (i) form of fraud or abuse, (ii) non-compliance with applicable laws and/or regulations, (iii) non-compliance with Dint.com values and guidelines, (iv) inappropriate or unlawful behavior, which includes (but not limited to) the following: Violence, threat, harassment, discrimination, hate speech, endangerment, invasion of privacy, human trafficking, exploitation of children, and obscenity in relation to Dint.com (or its employees and agents), the Trip Provider (or its employees and agents), and/or third parties, or (v) other circumstances that—at Dint.com&#39;s sole discretion—reasonably justify Dint.com taking any of the measures above.
            
            10. Intellectual Property Rights
            
            Unless stated otherwise, the software required for our services or available at or used by our Platform and the intellectual property rights (including the copyrights) of the contents and information of and material on our Platform are owned by Dint.com, its Trip Providers or providers.
            
            Dint.com exclusively retains ownership of all rights, title and interest in and to (all intellectual property rights of) (the look and feel (including infrastructure) of) the Platform on which the service is made available (including the guest reviews and translated content) and you are not entitled to copy, scrape, (hyper-/deep)link to, publish, promote, market, integrate, utilize, combine or otherwise use the content (including any translations thereof and the guest reviews) or our brand without our express written permission. To the extent that you would (wholly or partly) use or combine our (translated) content (including guest reviews) or would otherwise own any intellectual property rights in the Platform or any (translated) content or guest reviews, you hereby assign, transfer and set over all such intellectual property rights to Dint.com. Any unlawful use or any of the aforementioned actions or behaviour will constitute a material infringement of our intellectual property rights (including copyright and database right).
            
            11. Applicable law, jurisdiction & dispute resolution
            
            The original UK English version of these Terms and Conditions may have been translated into other languages. The translated version is a courtesy and office translation only and you cannot derive any rights from the translated version. In the event of a dispute about the contents or interpretation of these terms and conditions or inconsistency or discrepancy between the UK English version and any other language version of these terms and conditions, the UK English language version to the extent permitted by law shall apply, prevail and be conclusive. The UK English version is available on our Platform (by selecting "English (UK)" language) or shall be sent to you upon your written request.
            
            If any provision of these terms and conditions is or becomes invalid, unenforceable or non-binding, you shall remain bound by all other provisions hereof. In such event, such invalid provision shall nonetheless be enforced to the fullest extent permitted by applicable law, and you will at least agree to accept a similar effect as the invalid, unenforceable or non-binding provision, given the contents and purpose of these terms and conditions.
            
            12. About Dint.com and the support companies
            
            The Trip Service is rendered by Dint.com, which is a private company, incorporated under the laws of the Delaware and having its offices at 16192 Coastal Highway
            Lewes, DE 19958 USA and registered with the trade register of the Chamber of Commerce in USA.
            
            Dint.com has its headquarters in Amsterdam, the Netherlands and is supported by various affiliated group companies (the &#34;support companies&#34;) throughout the world. The support companies only provide an internal supporting role to and for the benefit of Dint.com. Certain designated support companies render limited customer care support services (only by telephone). The support companies do not have any Platform (and do not in any way control, manage, maintain, or host the Platform). 
            The support companies do not have any power or authority to render the Trip Service, to represent Dint.com, or to enter into any contract in the name of, for or on behalf of Dint.com. You do not have a (legal or contractual) relationship with the support companies. The support companies do not operate and are not authorized to act as any form of process or service agent of Dint.com. Dint.com does not accept nor assume any domicile at any place, location, or office in the world (also not at the office of its support companies), other than its registered office in Amsterdam.
            
            13. Governing Law and Disputes
            
            Dint.com is committed to customer satisfaction. We will try to resolve any concerns or problems with our services that you have. If we are unsuccessful, you may pursue a claim against Dint.com as explained in this Disputes provision. This Disputes provision lays out: (1) the initial process you must follow by reporting your claim to Dint.com prior to filing any arbitration or law suit in accordance with this Disputes provision; and, if we are unable to resolve your claim, (2) the recourse that you have to arbitration.
            
            To the extent permitted by law, these terms and conditions and the provision of our services shall be governed by and construed in accordance with Dutch law. By using this website, you agree that any and all disputes arising out of or relating to your use of this website, or other services provided by Dint.com or the support companies in connection with your use of this website (including the interpretation and scope of this clause and the arbitrability of the dispute), will be resolved via mandatory, binding arbitration.
            
            Nothing in this Disputes provision shall be read to create any legal rights that do not otherwise exist under the law or constitute any waiver of any personal jurisdiction defense, nor shall this Disputes provision give you the right to pursue any claim for relief that is not cognizable under the law.
            
            Prior to initiating arbitration, as discussed further below, you must give us an opportunity to resolve any complaints you have relating to your use of the Dint.com website, any dealings with our customer service agents, any services or products provided, or our Privacy Policy by submitting them to customer.service@Dint.com (the “Internal Review Procedure”). Your email to customer.service@dint.com beginning the Internal Review 
            Procedure must contain the following information: (1) your name, (2) your address, (3) the email address you used to make your reservation, (4) your reservation number, (5) the date of your reservation, (6) the name of the property that you reserved, (7) a brief description of the nature of your complaint, and (8) the resolution that you are seeking (together, the “Required Information”). Additionally, the subject line of your 
            email must state, “Request Under Disputes Provision.” If your email does not have this subject line, or if it does not contain all of the Required Information (or an explanation of why you are unable to include any of the Required Information), then you have not effectively begun the Internal Review Procedure, which you must do before initiating any arbitration or other legal action against Dint.com. If we are not able to resolve your complaint within 60 days of your starting the Internal Review Procedure, you may seek relief as laid out in this Disputes provision.
            
            Arbitration shall be initiated through and administered by the American Arbitration Association (“AAA”). Should the AAA decline to administer the arbitration or otherwise be unable to administer the arbitration for any reason, you agree that Dint.com will select an alternative arbitral forum, and that you will agree in writing to administration of the arbitration by the alternative arbitral forum selected by Dint.com.
            
            In order to initiate arbitration, you and Dint.com each will be responsible for paying the filing fees required by the AAA. In the event that you are able to demonstrate that the costs of arbitration will be prohibitive as compared to costs of litigation, Dint.com will pay as much of your filing fee in connection with the arbitration as the arbitrator deems necessary to prevent the arbitration from being cost-prohibitive as compared to the costs of litigation.
            
            Arbitration will be conducted in accordance with the AAA’s rules. If there is a conflict between the AAA’s rules and this Disputes provision, the terms of this Disputes provision will govern. The rules are available online at www.adr.org or by calling the AAA at 1-800-778-7879. If the AAA is unable or unwilling to administer the arbitration for any reason, then arbitration will proceed in a substantially similar fashion as it would under the AAA’s rules.
            
            The arbitration will be conducted by one arbitrator, who will be appointed by the AAA. You agree that the arbitration will be conducted in the English language. For claims under $25,000, the arbitration will not involve any personal appearance by the parties or witnesses but will instead be conducted based solely on written submissions, unless you request an in-person or telephonic hearing or the arbitrator determines that an in-person or telephonic appearance is required. In the case of a hearing, the presumption shall be in favor of a telephonic hearing, unless the arbitrator determines that a party’s right to a fundamentally fair process would be impaired without an in-person hearing. In the case of an in-person hearing, the hearing shall be conducted in a mutually convenient location. Dint.com will ordinarily request that the hearing be held in Chicago, Illinois. You may petition the arbitrator to select an alternative location for the hearing. The arbitrator’s selection of a hearing location shall be final and binding. You agree that in the event of an in-person hearing, any Dint.com employee or affiliate who is based outside of the United States and who is participating in the hearing may participate by telephone or video conference, and his or her physical presence will not be required.
            
            Arbitration will be subject to the Federal Arbitration Act and not any state arbitration law. This agreement to arbitrate is made under and will be governed by and construed in accordance with the laws of the Netherlands, consistent with the Federal Arbitration Act, without giving effect to any choice-of-law principles that provide for the application of the law of another jurisdiction.
            
            The arbitration will be confidential, and neither you nor Dint.com may disclose the existence, content or results of any arbitration, except as may be required by law or for purposes of enforcement of the arbitration award.
            
            Ordinarily, pre-hearing information exchange will be limited to the reasonable production of non-privileged documents directly relevant to the dispute. Unless the arbitrator determines that an additional form of information exchange is necessary to provide for a fundamentally fair process, those documents will be limited to your booking and communications directly about that booking among you, Dint.com, and the accommodation(s) that are the subject of your dispute with Dint.com. Any issues regarding discovery, or the relevance or scope thereof, will be determined by the arbitrator, and the arbitrator’s determination will be conclusive.
            
            The arbitrator may not consolidate more than one person’s claims and may not otherwise preside over any form of a representative or class proceeding. There will be no right or authority for any Claims to be arbitrated on a class action basis. You understand and agree that, by accepting these terms and conditions, you and Dint.com are each waiving the right to a trial by jury or to participate in a class action with respect to the claims covered by this mandatory arbitration provision.
            
            You are thus giving up your right to go to court to assert or defend your rights. Your rights will be determined by a neutral arbitrator, and not a judge or jury. The arbitration procedures mandated by this Disputes provision are simpler and more limited than the procedures applicable in most courts. Arbitrator decisions are as enforceable as any court order and are subject to very limited review by a court.
            
            All claims you bring against Dint.com must be resolved in accordance with this Disputes provision. All claims filed or brought contrary to this Disputes provision, including claims not first submitted through the Internal Review Procedure, will be considered improperly filed and void. Should you file a claim contrary to this Disputes provision, Dint.com will notify you in writing of the improperly filed claim, and you must promptly withdraw the claim.
            
            This Disputes provision was amended by Dint.com effective September 7, 2021. If you have a claim that relates to a booking made prior to that date, you may choose to proceed under the provision in effect when you made your booking. If you would like to do that, please so indicate in your claim submission. Otherwise, by submitting a claim, you agree that this Disputes provision will apply to your claim.</p>'],
        ]);
    }
}
