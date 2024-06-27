<?php


    require_once "db_connect.php";

    global $conn;

    $x = 1;


    $newsArray = [
        "New Study Shows COVID-19 Vaccine Efficacy Maintains Over 90%",
        "Breakthrough in Vaccine Research Could Lead to Universal Flu Shot",
        "Government Announces Plan for Free Childhood Vaccinations",
        "Experts Recommend Booster Shots for Long-Term Immunity",
        "Vaccine Distribution Efforts Expand to Rural Communities",
        "Vaccine Trials Show Promising Results in Elderly Populations",
        "Research Indicates New Vaccine Could Combat Emerging Viral Strains",
        "Healthcare Workers Applaud Effectiveness of Latest Vaccine Rollout",
        "Global Leaders Pledge Support for Vaccination Initiatives",
        "Debate Ensues Over Vaccine Mandates in Public Spaces",
        "Public Health Officials Stress Importance of Influenza Vaccine",
        "Study Suggests Link Between Vaccination Rates and Community Health",
        "Pharmaceutical Company Announces Breakthrough in Cancer Vaccine",
        "Parents Divided Over Vaccine Requirements for School Attendance",
        "New Vaccine Delivery System Aims to Enhance Accessibility",
        "Vaccine Adverse Reaction Rate Declines, Says Health Agency",
        "Scientists Develop Nasal Spray Vaccine for Common Cold",
        "Immunization Campaign Targets High-Risk Groups",
        "Legislation Proposed to Strengthen Vaccine Safety Monitoring",
        "Vaccine Hesitancy Decreases Amid Public Awareness Campaign",
        "Researchers Explore RNA Technology for Next-Generation Vaccines",
        "Study Finds Childhood Vaccine Schedule Safe and Effective",
        "Community Outreach Program Boosts Vaccine Acceptance Rates",
        "Government Funds Research into Vaccine for Emerging Diseases",
        "New Vaccine Shows Promise in Preclinical Trials",
        "Anti-Vaccine Movement Faces Backlash from Medical Community",
        "Public Poll Shows Majority Support for Mandatory Vaccinations",
        "Vaccine Manufacturing Capacity Expands to Meet Global Demand",
        "Health Ministry Urges Vaccination for International Travel",
        "Scientific Breakthrough: Vaccine Effective Against Multiple Strains",
        "Vaccine Distribution Challenges Highlighted in Rural Areas",
        "Experts Warn Against Vaccine Misinformation on Social Media",
        "Vaccine Research Receives Record Funding from Philanthropists",
        "Community Clinic Offers Free Flu Shots to Low-Income Families",
        "Study Finds Herd Immunity Achievable With Higher Vaccine Coverage",
        "Vaccine Rollout Program Celebrates Milestone of 100 Million Doses",
        "Government Launches Campaign to Educate Public on Vaccine Benefits",
        "Doctors Emphasize Importance of Vaccines for Pregnant Women",
        "Immunization Drive Targets School-Age Children",
        "Researchers Investigate Vaccine Effectiveness Over Time",
        "New Vaccine Initiative Aims to Eradicate Malaria by 2030",
        "Global Vaccine Summit Addresses Equity in Access",
        "Vaccine Manufacturing Plant Opens in Developing Country",
        "Family Physicians Play Crucial Role in Vaccine Distribution",
        "Community Leaders Advocate for Vaccine Equity",
        "Immunization Rates Increase Among Seniors, Study Shows",
        "Vaccine Approval Process Streamlined for Emergency Use",
        "Government Launches App to Track Vaccine Side Effects",
        "Researchers Develop DNA-Based Vaccine Platform",
        "Study Finds Flu Vaccine Reduces Hospitalizations in Children",
        "Vaccine Distribution Center Offers Drive-Thru Service",
        "Healthcare Providers Prepare for Annual Flu Vaccine Season",
        "New Vaccine Storage Technology Extends Shelf Life",
        "Vaccine Outreach Efforts Reach Underserved Communities",
        "Government Invests in Research for Universal Flu Vaccine",
        "Vaccine Safety Panel Reports No Serious Adverse Events",
        "Study Explores Combination Vaccine for Multiple Diseases",
        "Public Health Campaign Targets Vaccine Myths and Misinformation",
        "Immunization Clinic Implements Appointment-Free Vaccinations",
        "Government Allocates Funds for COVID-19 Booster Shots",
        "New Vaccine Clinic Opens in High-Demand Area",
        "Study Finds Link Between Vaccination Rates and Public Health Outcomes",
        "Vaccine Production Ramp-Up to Meet Growing Demand",
        "Health Officials Announce Immunization Schedule Updates",
        "Vaccine Supply Chain Resilience Tested Amid Global Challenges",
        "Research Indicates Potential for HIV Vaccine Breakthrough",
        "Medical Experts Advocate for Annual Vaccine Updates",
        "Vaccine Distribution Logistics Improved with New Technology",
        "Local Pharmacies Participate in National Vaccine Program",
        "Study Shows Flu Vaccine Effectiveness Surpasses Expectations",
        "Vaccine Education Campaign Reaches Milestone of 1 Million Engagements",
        "Government Allocates Funds for Research on Vaccine Safety",
        "Community College Offers Vaccine Education Course",
        "Study Demonstrates Effectiveness of New Vaccine Adjuvant",
        "Vaccine Awareness Week Highlights Importance of Immunization",
        "Researchers Investigate Potential Link Between Vaccination and Autism",
        "Immunization Drive Targets Vulnerable Populations",
        "Health Department Launches Vaccine Hotline for Public Inquiries",
        "Study Finds Public Confidence in Vaccine Safety at All-Time High",
        "Vaccination Program Reaches Milestone of 1 Billion Doses Administered",
        "New Vaccine Study Receives International Collaboration",
        "Breakthrough in Tuberculosis Vaccine Research",
        "Global Vaccine Access Initiative Announces New Partnerships",
        "Immunization Clinic Offers Weekend Hours for Working Families",
        "Study Links Childhood Vaccination Rates to Lower Disease Incidence",
        "Vaccine Development Accelerated With AI Technology",
        "Community Health Center Hosts Drive-Thru Flu Shot Event",
        "Research Shows Vaccine Adherence Linked to Education Level",
        "New Vaccine Distribution Center Opens in Major City",
        "Vaccine Clinic Volunteers Recognized for Community Service",
        "Government Launches Public Awareness Campaign on Vaccine Safety",
        "Study Finds Vaccine Effectiveness Against Variants",
        "Immunization Task Force Urges Annual Flu Vaccination",
        "Vaccine Distribution Logistics Addressed in National Strategy",
        "Clinical Trial Results Show Positive Vaccine Response",
        "Government Provides Grants for Research into COVID-19 Vaccine Variants",
        "Medical Experts Debate Strategies for Vaccine Deployment",
        "New Vaccine Packaging Designed for Sustainability",
        "Study Finds Link Between Immunization Rates and Economic Benefits",
        "Vaccine Acceptance Rate Increases Among Young Adults",
    ];

    // Pick a random news headline
    $randomNews = $newsArray[array_rand($newsArray)];


    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../../PhpMailer/src/Exception.php';
    require '../../PhpMailer/src/PHPMailer.php';
    require '../../PhpMailer/src/SMTP.php';

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username='communicraftt@gmail.com';
    $mail->Password = 'wywsxddlhdkqbaor';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('communicraftt@gmail.comm','BabyVaxTracker');

    $query = "SELECT email FROM users WHERE users.subscribed = ?";
    $stmt = $conn ->prepare($query);
    $stmt->bind_param("i",$x);
    $stmt->execute();
    $result = $stmt->get_result();

    for($i =0 ; $i < $result->num_rows; $i++){
        $row = $result->fetch_assoc();
        $email = $row['email'];

        $mail->addAddress($email); // Add a recipient

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'News Letter';
        $mail->Body    = $randomNews;

        try {
            // Your PHPMailer setup and email sending code here
            $mail->send();
            exit();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    }














