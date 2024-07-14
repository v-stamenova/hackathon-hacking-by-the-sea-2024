# Hacking by the Sea 2024
## Problem Statement
 When students form study groups, they often need to assistance from a knowledgeable person to guide and facilitate the session. Unfortunately, it is not always feasible to have dedicated persons available at different times of the day

 ## Goal
 Build a real-time group study session facilitator. First, students should be able to create and join a group study session. These study sessions take place in person or virtually (as some students can join over the Internet). The session must have a topic (Laravel exam, Data Science assignment), a goal (study for an exam, create a presentation, finish an assignment) as well as time limits (three hours with 6 breaks).  

The session must be facilitated by an AI Study Leader, SAM. SAM must have basic knowledge about the course as well as the assignment. He must then ensure that that students are working towards the goal. SAM should be able help students, but not provide answers. For example, should a student run into a problem, SAM must only provide tips and hints to guide the student to the correct answer without providing it at all. 

SAM must also take an active role in the session. That is, he should not only respond to students, but have an idea of what it wants to accomplish (subgoals that it creates based on the ultimate goal the students set). After a set amount of time, he must actively guide the study session toward the end goals. SAM must not only passively answer questions.

## Solution
Using Laravel a web app called DaanGPT was created. In the application students can register and create study sessions between each other. Each study session has a goal and subject. The creator of the room can invite friends.

If while working together towards the goal, the students encounter error they can ask Daan for help. In the chat they can start their message with `@Daan` and they will receive guidance but not the direct answer.

The tech stack here is Laravel (PHP framework), Livewire, TailwindCSS and real-time communication Laravel Reverb (Websocket server).

The application requires the ExpressJS server that can be found [here](https://github.com/snowbalzz/assistant), created by [snowbalzz](https://github.com/snowbalzz). The ChatGPT assistant also trained by [snowbalzz](https://github.com/snowbalzz).

![alt text](image.png)
