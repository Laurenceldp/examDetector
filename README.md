# examdetector
MSc Software Dissertation project 

Problem Specification / Project Plan: Academic dishonesty in online examinations
This proposal outlines the plan for a dissertation that will evaluate the use of Artificial Intelligence (AI) proctoring as part of online examinations. There are several factors that have led to the need for software that can determine dishonesty in online examinations; increased distanced learning, online learning, and the technological shift in how information is collected by students (Nizam, Gao, Li, Mohamed, & Wang, 2020). A study by the National College Testing Association found that the opportunity for academic dishonesty in exams increases, especially when taken in unproctored environments (Dyer, Pettyjohn, & Saladin, 2020).
Research in 2014 noted that academic dishonesty or unethical behaviour has been growing in online examinations as a result of the use of technology and the Internet (Ullah, Xiao, Barker, & Lilley, 2014). As digital learning and e-learning grows, testing and invigilation techniques need to advance to meet this. Universities UK have reported that in 2016–17, online learning made up 8% of all provision at UK higher education institutions with the number of UK higher education institutions offering online studies rising from 102 in 2010–11 to 117 in 2016–17 (UK, 2018). Massive open online courses (MOOCs) have also significantly expanded the role of online education with institutions able to enrol students that would not be able to access a campus (Liu, 2017). 

Along with the complexity of monitoring academic dishonesty in online examinations, the Covid 19 pandemic has highlighted a new educational challenge of how to test students within an unprecedented environment (Nizam, Gao, Li, Mohamed, & Wang, 2020). This is in part due to the complexity involved in monitoring and assessing candidate participation. 

On 23 March 2020, the UK Prime Minister announced legislation had passed that would prevent people from leaving their homes or attending a workplace unless for essential reasons. Using Queen’s University Belfast as an example: this led to the displacement of over 24,000 students and 4,000 staff (QUB, 2020). A response to this was that educators begun to investigate and implement alternative examination methods including digital examination platforms (QUB, Alternative assessment information, 2020). 
The purpose of this dissertation will be to create a piece of open source software that can evaluate eye movement and or cursor movement to determine the possibility of a candidate cheating on an online exam. It is expected that the software will work with standard home use web cams or laptop cams and will produce data and or alerts of unusual activity. 

There are several key issues that prevent exam hall protocols of invigilation being implemented in an online exam. These problems form the basis for the dissertation problem that will be investigated:

a)	Academic dishonesty – some students may take advantage of the ability to use second browser tabs, additional reference materials or alternative communication channels with peers during the exam to be able to cheat. Mobile phones and information sharing are common problems in ensuring exam integrity (Accountants, 2017).  
b)	Ease of use of new technology – Invigilators with varying IT experience are having to use new systems quickly. During the Covid period training methods are digital or video based to allow for social distancing measures, this could also lead to confusion and missed functionality of software programs. 
c)	Invigilation of real time exams – Even with exam software in place it can be challenging to invigilate real time exams. Software may offer lockdown browsers, or video and mic recording, however as the number of candidates taking an exam grows video and mic proctoring becomes less useful.  
d)	Variables in exam content – Exams can be open book, require a candidate to use pen and paper for calculations or as a method of structuring essay question answers. During this time, the monitoring of unusual activity is particularly difficult as a candidate is required or allowed to interact with materials outside of the screen. As online learning and testing grows it is noted that open book tests may be more relevant than close book tests (Nizam, Gao, Li, Mohamed, & Wang, 2020).

To resolve these issues, it is intended that an open source web-based software application will be created to implement the following: 
e)	Academic dishonesty – It is intended that the platform will allow for the evaluation of real time or recorded video, mic, and audio transmission, detecting unusual movement or behaviour that would suggest a candidate is attempting to cheat on an exam.  
f)	Ease of use of new technology – It is expected that the platform will use human computer interaction design tools to ensure that the platform is easy to use and obvious when used. 
g)	Invigilation of real time exams – It is anticipated that the platform will allow for scalability to ensure large numbers of candidates can be invigilated in one exam sitting.   
h)	Variables in exam content – It is expected that the platform will adjust for open book or essay-based exams, with an adjustment to the calculations for long periods of non-screen gaze time.  

Technology scope:
To develop the platform, it is anticipated that the following languages and code frameworks will be used. These suggestions may change as the project progresses. 
Technology scope
Academic dishonesty  	Web platform to be built using WebGazer as a starting point. JavaScript based. 

Ease of use of new technology	Bootstrap for UX/UI. 
Invigilation of real time exams 	SQL/MongoDB set up for scalability. 
Variables in exam content  	Data collection/statistics to build algorithms 
Possible languages: 
	PHP/JavaScript/Python/HTML/CSS
Possible Frameworks:
	Django/Laravel/Ajax/Flask/Bootstrap


Problem domain: 
On researching examination software platforms such as ExamSoft, Question Mark, Respondus and SpeedWell eSystem it is noted that all platforms offer varying degrees of exam integrity, however they are not open source. It is expected that the platform will try to create an open sourced opportunity so that further research can be continued by global communities in relation to real time and or recorded video eye movement tracking.  

It is anticipated that the researcher will focus on the cognitive science, data statistics and AI elements of eye tracking/cursor movement, along with its current market applications and research produced in the field. 

Academic dishonesty and cheating in general have been shown to relate to more than opportunity (Dyer, Pettyjohn, & Saladin, 2020). Psychological theories on cheating range from environmental factors such as lighting to moral development (Konnikova, 2013). The impact of when and how students cheat can be accelerated by online exams, with 70% of students admitting to cheating on online exams (Dyer, Pettyjohn, & Saladin, 2020).

Although AI proctoring may advance the ability to test students in real time online exams, there may also be privacy issues in the recording and storing of personal data (Education, 2020). 


User stories and user interface: 
It is expected that two main users will make use of the software. 
a)	A candidate taking an exam
b)	An educator using the software to invigilate 
User stories have been provided below to highlight possible acceptance criteria and software goals. User Interface wireframes have been included to guide the potential visual appearance of the platform. 
User Story 	Acceptance Criteria
Candidate
As a candidate I want to complete the examination without having to learn to use a new platform	Platform is obvious and easy to use to a range of IT skills 
As a candidate I do not want my exam grade to be affected when using the recording software	Distraction by software/feedback is minimised when using platform

Invigilator
As an invigilator I want to be able to use the software quickly and easily 	Platform is obvious and easy to use to a range of IT skills
As an invigilator I want to be able to ensure exam integrity 	Software advises on possible academic dishonesty through evaluating video, mic, and cursor movement of candidates
As an invigilator I want to be able to invigilate large groups of candidates 	Software allows for easy scalability for multiple users 
As an invigilator I want to ensure exam integrity even when exams are open book or essay-based	Software adjusts for exams using open books or essay questions


Project content: 
To develop the project, it is anticipated that a mock platform will initially be created to test if a candidate/user is looking on screen or off screen. This will be written in JavaScript and make use of a Flask HTTPS local server written with python. This platform will be expanded to detail specific gaze patterns or heat maps, identifying trends in data sets that would allow for an AI program to be able to evaluate if unusual behaviour is taking place. 
It is expected that initial data used will come from the WebGazer study by a team at Brown University (Group, 2020). This will be built on by data collected by the researcher focusing on 2 sets of behaviour within an exam environment: not cheating and intentionally cheating. It is hoped through this data trends can be read, and the project will progress to be able to identify the traits in academic dishonesty. Further data could be needed and will be assessed as the project continues. 
It is the intention at the end of the project that a demo product will be available, alongside a video demo and dissertation paper. 
The project requires the researcher to acquire new skill sets, including a level of competence in new coding languages and areas of cognitive science, statistics, and AI. As such, it will be managed as an agile project, creating small working demos for each iteration. This may mean that technology, data requirements and research elements could change throughout the project. 


Bibliography
Accountants, A. o. (2017). Cheating in exams - the consequences . London: Association of International Certified Professional Accountants.
Dyer, J. M., Pettyjohn, H. C., & Saladin, S. (2020). Academic Dishonesty and Testing:How Student Beliefs and Test Settings Impact Decisions to Cheat. Journal of the National College Testing Association.
Education, T. H. (2020, 05 22). EU lawmakers call for online exam proctoring privacy probe. Retrieved from Times Higher Education: https://www.timeshighereducation.com/news/eu-lawmakers-call-online-exam-proctoring-privacy-probe
ExamSoft. (2020, 05 16). ExamSoft. Retrieved from ExamSoft: https://examsoft.com/
Group, B. H. (2020, 05 16). WebGazer . Retrieved from https://webgazer.cs.brown.edu/#home: https://webgazer.cs.brown.edu/#home
Konnikova, M. (2013, October 31). Inside the Cheaters Mind. The New Yorker.
Limited, Q. C. (2020, 05 16). Questionmark. Retrieved from Questionmark: https://www.questionmark.com/?lang=en_GB
Liu, X. (2017). Automated Online Exam Proctoring. IEEE Transactions in Multimedia .
Nizam, N. I., Gao, S., Li, M., Mohamed, H., & Wang, G. (2020). Scheme for Cheating Prevention in Online Exams during Social Distancing . New York: Department of Biomedical Engineering, Rensselaer Polytechnic Institute .
QUB. (2020, 05 20). Alternative assessment information. Retrieved from www.qub.ac.uk: https://www.qub.ac.uk/home/coronavirus-faqs/information-for-students/
QUB. (2020, 05 20). QUB Annual Report 2018-19. Retrieved from www.qub.ac.uk: https://www.qub.ac.uk/directorates/FinanceDirectorate/visitors/FileStore-Visitors/financial-statements/Filetoupload,939623,en.pdf
Respondus. (2020, 05 16). Respondus . Retrieved from Respondus: https://web.respondus.com/
Soft, E. (2020, 05 20). Exam Soft. Retrieved from https://examsoft.com: https://examsoft.com/solutions/exam-monitor
Software, S. (2020, 05 16). Speedwell Software . Retrieved from Speedwell Software: https://www.speedwellsoftware.com/
UK, U. (2018). Flexible Learning - The Current State of Play in UK Higher Education. London: Universities UK .
Ullah, A., Xiao, H., Barker, T., & Lilley, M. (2014). Evaluating security and usability of profile based challenge questions authentication in online examinations. Journal of Internet Services and Applications.
Williamson, M. H. (2018). Online Exams: The need for best practices and overcoming challenges . The Journal of Public and Professional Sociology .

