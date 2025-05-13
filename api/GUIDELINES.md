# Development guidelines

This document is your go-to resource for understanding our project's coding conventions, collaboration practices, and quality standards. Our aim is to create a cohesive, secure, and efficient codebase that not only meets our project's objectives but also adheres to industry best practices.

## Purpose

The purpose of these guidelines is to ensure that all contributors to the project can work effectively and harmoniously. By following these guidelines, we aim to:

- Maintain a high code quality and consistency across the codebase.
- Facilitate efficient collaboration among team members and contributors.
- Streamline the development and review processes.
- Ensure the security and performance of the application.

## Coding Standards

- Language-specific conventions: Follow the widely accepted conventions for the PHP language and OctoberCMS.
- Commenting and documentation: Write meaningful comments that explain the "why" behind complex logic. Document every function, class, and module with clear descriptions of their purpose and usage.

## Git Workflow

- Branching strategy: Create a new branch for each feature, bug fix, or improvement.
- Commit messages: Write clear, concise commit messages that describe the changes made and the reason for them.
- Pull Requests (PRs): Submit PRs for any changes to the codebase. Ensure that your PRs are small enough to be reviewed effectively and include a summary of the changes made.

## Security Practices
- Secure coding: Follow secure coding practices to avoid introducing vulnerabilities.
- Sensitive data: Never commit sensitive information (e.g., API keys, credentials) into the version control system.

## Directory structure

Example directory structure that may be helpful to organize your code:
```
appplugin/plugin
├── classes
│   ├── constants
│   │   └── Regex.php
│   ├── emails
│   │   └── ExampleEmail.php
│   ├── enums
│   │   └── ExampleEnum.php
│   ├── extends
│   │   └── ExampleExtend.php
│   ├── services
│   │   └── ExampleService.php
│   ├── traits
│   │   └── ExampleTrait.php
│   └── utils
│       └── ExampleUtil.php
├── config
│   └── config.php
├── controllers
│   └── Examples.php
├── http
│   ├── controllers
│   │   └── ExampleController.php
│   ├── middlewares
│   │   └── ExampleMiddleware.php
│   ├── modelbinds
│   │   └── ExampleModelBind.php
│   ├── requests
│   │   └── ExampleRequest.php
│   └── resources
│       └── ExampleResource.php
├── models
│   └── ExampleModel.php
├── repositories
│   ├── interfaces
│   │   └── IExampleRepository.php
│   └── ExampleRepository.php
├── updates
│   └── YYYY_MM_DD_create_example_table.php
└── views
    ├── layouts
    │   └── layouts
    │       └── example.htm
    └── mail
        └── mail
            └── example.htm
```
### Classes

- Central directory for classes that can't be properly placed elsewhere

- **Constants**
    - Plugin constants, such as regexes, error messages...
- **Email**
    - Plugin email classes
- **Enums**
    - Plugin enums
- **Extends**
    - Any static extends that are needed to extend other plugins
- **Services**
    - Helpful services for example calling an external API
    - May be used to define a complex logic that if needed
    - Each *service should implement an interface* and be binded to that interface
    - Afterwards, you can inject the service into your class in a constructor using the Interface, which will be automatically resolved to a proper class
- **Traits**
    - Plugin traits
- **Utils**
    - Plugin utils for defining helper functions, shouldn't be too complex
    - Util functions should be *static*

### Config

- Plugin config

### Controllers

- OctoberCMS backend controllers

### HTTP

- Central directory for REST API

- **Controllers**
    - REST API controllers
    - *Shouldn't contain complex logic* (use services or repositories for this)
    - Controller *should call proper services, repositories*, ex. and just return a response
    - *Validation may be done here*
    - Controllers *should always return a resource, not the model*
- **Middlewares**
    - Any middlewares
- **ModelBinds**
    - Any model binds specific for that plugins models
- **Requests**
    - Any requests that the controllers need
    - Should be properly validated
- **Resources**
    - Any resources returned by the controllers

### Models

- Any database models

### Repositories

- Repositories are used to handle CRUD operations on a specific model, for example MessageRepository could handle getting, updating, creating and deleting messages
- **Always use a repository to perform changes on a model!**
- Repositories should implement an interface and injected into proper classes just like the services

### Updates

- Database migrations
- Migrations should follow the naming: **YYYY_MM_DD_create_example_table.php**

### Views

- Views specific for email handling
- **Layouts**
    - Email layouts
- **Mail**
    - Email templates
- If email translations are needed, use locale subdirectory structure, just like in the lang directory

## Responses

- For handling responses and errors in application use the **Api** plugins
- It handles the process of making unified responses and throwing unified exceptions
- For details check README.md of these plugins

## Responses explained

- All the responses from backend are unified
- The required fields of each response are:
    - **type**
        - Specifies the response type: *error*, *warning*, *success*, *info*
    - **is_toast**
        - Specifies whether the response message should be shown as a popup on frontend
    - **message**
        - Message specific to that response
- Responses may additionaly contain these fields:
    - **data**
        - Actual data such as model information, or collections of models, ex.
    - **pagination**
        - Pagination is handled internally by OctoberCMS, it consists these 2 fields:
            - **meta**
            - **links**
    - **errors**
        - Additional information about errors
        - Usually, responses that have status code **422 - Unprocessable Content** will contain this field which is an array, where *key is the field of the request* and *value is an actual error*
