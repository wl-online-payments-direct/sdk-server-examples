FROM eclipse-temurin:21-jdk AS build

WORKDIR /app

# Copy Maven files
COPY pom.xml .
COPY src ./src

# Build the application with Spring Boot repackage
RUN apt-get update && apt-get install -y maven && \
    mvn clean package spring-boot:repackage -DskipTests && \
    rm -rf /root/.m2

FROM eclipse-temurin:21-jre

WORKDIR /app

# Copy the built JAR from the build stage
COPY --from=build /app/target/*.jar app.jar

EXPOSE 3000

ENTRYPOINT ["java", "-jar", "app.jar"]