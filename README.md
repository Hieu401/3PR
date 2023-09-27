# 3PR
3PR stands for PRogression, PeRformance, and Personal Records. This app is designed to track and help achieve fitness goals for devoted athletes.
This app also helps me practice my developer skills :D

With this app you can create a personal account, manage your goals (Personal Records), enter Performance data, and set up plans (Progression).
With this data, the app automatically creates daily plans for you that you can retrieve during your training sessions.

## Architecture
This app is build on a Microkernel Architecture style. I use Docker to containerize my Web API services, Nginx to act as my API gateway and RabbitMQ for data synchronization between services.
Currently I do not have a front end, but when available I plan on using Tauri Mobile to create Mobile apps which allows me to use Rust for client side business logic and any Javascript framework of my choice for GUI logic. The MVVM pattern is a well known pattern, but I am thinking of implementing MVU for a more functional and referential transparent flavor.
I currently plan on using SolidJS, Svelte, Qwik or Astro depending on the requirements of the mobile app.

## Tech Stack

Besides Docker, Nginx, RabbitMQ, and obviously Git I use different langauges and frameworks for my Microservices and Microkernel. There are currently 2 Microservices and 1 Microkernel. They all use their own database all running on Postgres. 

### Authentication service and Session manager (3PRAuth)

This Microservice is responsible for creating accounts and logging in users using JSON Web Token (JWT). JWT has been chosen in contrast to cookie sessions because all auth data are saved in these tokens which can be read by any Microservices which makes the authentication, authorization and session management easier in a microkernel architecture. User data is hashed and saved in the database. Because the service is not big, I used NodeJS + ExpressJS as tools for implementation. This small minimal stack offers enough tools to handle incoming HTTP requests and return HTTP responses.

### Microkernel (3PRKernel)

A Microkernel is the heart of the system. Critical features are in this small system which are goal and plan management. The Microkernel is able to use the JWT from the Authentication service for authorization purposes. Users can then use endpoints to View/Create/Edit/Delete their Goals and Plans. Because of increase in complexity, PHP + Laravel has been chosen for their complete set of tools. Tools that have been used are DB connection management, Database Migrations, Eloquent (Object Relational Mapper), Models, Routers, Controllers, Custom Requests, Validators, and Middleware. AMQP channels are also programmed in this system for data synchronization with the Training Session Microservice because their databases overlap on the dataset. This means that they share the same data that can be found on both databases. To ensure that the shared data is the same on both ends, we use RabbitMQ (AMQP channels). The Microkernel produces a message to the the Microservice to update their data whenever data is changed in the Microkernel database.

### Training Session manager (3PRTrainingSession)

This Microservice is responsible for managing training sessions. Users can View/Create/Edit/Delete their training sessions and add their goals to each session which should automatically offer a plan for this session based on their progression plan. Like the Microkernel, this Microservice also uses JWTfor authorization purposes. Because of th complexity, C# + ASP.net Core has been chosen as tech stack for this Microservice. ASP.net is similar as Laravel in the sense that they offer DB connection management, Database Migrations, Entity Framework (Object Relational Mapper), Models, Routers, Controllers, and Middleware. AMQP channels are also available in this system as the Consumer for messages produced by the Microkernel. This way, the Microservice can update their data accordingly.

## Future plans

I intend to add more features to this project in the far future. Namely:

- CICD automation (Jenkins)
- Monitoring tools (Prometheus, Grafana, Loki, Jaeger)
- Cloud features (AWS/Azure/Firebase)
- Frontend (Tauri + Rust + Javascript + SolidJS/Qwik/Astro/Svelte)
- Simple Container orchestration (Kubernetes)
- Apache Kafka if I can find a good use case
- Maybe some functional languages or other languages like Elixir/Erlang, F#, Go, Python + C/Cython, C++, or Rust if I can find a good use case for them


