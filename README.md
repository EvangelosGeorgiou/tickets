# Ticket Support System

[![Latest Version on Packagist](https://img.shields.io/packagist/v/epls-tickets/tickets.svg?style=flat-square)](https://packagist.org/packages/epls-tickets/tickets)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/epls-tickets/tickets/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/epls-tickets/tickets/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/epls-tickets/tickets/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/epls-tickets/tickets/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/epls-tickets/tickets.svg?style=flat-square)](https://packagist.org/packages/epls-tickets/tickets)

## Introduction

The Laravel Ticket Support Backend Package is a specialized solution for managing customer support requests and streamlining the back-end processes of your support system. This package is designed to empower your support team by providing the necessary tools for efficient ticket handling and resolution.


## Installation

You can install the package via composer:

```bash
composer require evangeo/support-tickets
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="tickets-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="tickets-config"
```

## Tables

### Ticket Table Structure

| Column Name           | Type                                     | Default             |
|-----------------------|------------------------------------------|---------------------|
| ID                    | `integer`                                | `NOT NULL`          |
| UUID                  | `string`                                 | `NOT NULL`          |
| subject               | `string`                                 | `NOT NULL`          |
| entity                | `string`                                 | `NOT NULL`          |
| entity_id             | `int`                                    | `NOT NULL`          |
| assigned_user         | `int`                                    | `NOT NULL`          |
| category_id           | `int`                                    | `NULL`              |
| internal_group_id     | `int`                                    | `NULL`              |
| status                | `enum` (open, re-open, closed, archived) | `open`              |
| waiting_response_from | `enum` (user, entity)                    | `NOT NULL`          |
| priority              | `enum` (low, normal, high)               | `low`               |
| closed_by             | `enum` (user, entity)                    | `NULL`              |
| created_at            | `timestamp`                              | `current timestamp` |
| created_by            | `int`                                    | `NULL`              |
| updated_at            | `timestamp`                              | `current timestamp` |
| modified_by           | `int`                                    | `NULL`              |
| deleted_at            | `timestamp`                              | `NULL`              |
| deleted_by            | `int`                                    | `NULL`              |

### Ticket Responses Table Structure

| Column Name | Type                        | Default             |
|-------------|-----------------------------|---------------------|
| id          | `integer`                   | `NOT NULL`          |
| ticket_id   | `int`                       | `NOT NULL`          |
| message     | `mediumText`                | `NOT NULL`          |
| type        | `enum` (external, internal) | `external`          |
| created_at  | `timestamp`                 | `current timestamp` |
| created_by  | `int`                       | `NULL`              |
| updated_at  | `timestamp`                 | `current timestamp` |
| modified_by | `int`                       | `NULL`              |
| deleted_at  | `timestamp`                 | `NULL`              |
| deleted_by  | `int`                       | `NULL`              |

### Ticket Attachment Table Structure

| Column Name | Type        | Default             |
|-------------|-------------|---------------------|
| id          | `integer`   | `NOT NULL`          |
| response_id | `int`       | `NOT NULL`          |
| name        | `string`    | `NOT NULL`          |
| mime        | `string`    | `NOT NULL`          |
| created_at  | `timestamp` | `current timestamp` |
| created_by  | `int`       | `NULL`              |
| updated_at  | `timestamp` | `current timestamp` |
| modified_by | `int`       | `NULL`              |
| deleted_at  | `timestamp` | `NULL`              |
| deleted_by  | `int`       | `NULL`              |

### Ticket Category / Internal Group / Tags Table Structure

| Column Name | Type      | Default    |
|-------------|-----------|------------|
| id          | `integer` | `NOT NULL` |
| name        | `string`  | `NOT NULL` |
| entity      | `enum`    | `NOT NULL` |
| enabled     | `boolean` | `1 `       |

### Ticket Tags Pivot Table Structure

| Column Name | Type      | Default    |
|-------------|-----------|------------|
| id          | `int`     | `NOT NULL` |
| ticket_id   | `int`     | `NOT NULL` |
| tag_id      | `int`     | `NOT NULL` |

## Usage

- Create Ticket as User
```php
$ticket = ticket()->createAsUser($userId, $ticketData)
```

- Create Ticket as Entity
```php
$ticket = ticket()->createAsEntity($entityId, $ticketData)
```

- Interact With Ticket Status
```php
$ticket->reOpen()
        ->open()
        ->archived()
```

- Interact With Ticket Category
```php
$ticket->setCategory($id)
        ->removeCategory()
```

- Interact With Ticket Internal Group
```php
$ticket->setInternalGroup($id)
        ->removeInternalGroup()
```

- Interact With Ticket Tags
```php
$ticket->attachTags([$tagId1,$tagId2,$tagId3])
       ->detachTags([$tagId1])
       ->syncTags([$tagId4, $tagId5, $tagId6])
```

- Create Ticket Response
```php
$reponse = $ticket->replyAsUser($userId, $responseData)

$reponse = $ticket->replyAsEntity($entityId, $responseData)
```

- Interact with Response Message Type
```php
$response->markAsInternalMessage()
         ->markAsExternalMessage()
```

- Upload Documents on Responses
```php
$response->attachDocuments($attachments, function (AttachmentRepository $repository) use ($uploads){
                $repository->upload($uploads, '/path/to/folder');
            })
```

- Chainable Functions
```php
$ticket = ticket()
            ->createAsUser($userId, $ticketData)
            ->setCategory($categoryId
            ->setInternalGroup($internalGroupId
            ->attachTags([$tagId1,$tagId2,$tagId3])
            ->detachTags([$tagId1])
            ->syncTags([$tagId4, $tagId5, $tagId6])
            ->reOpen()
            ->open()
            ->archived()
            ->replyAsUser($userId, $responseData)
            ->markAsInternalMessage()
            ->attachDocuments($attachments, function (AttachmentRepository $repository) use ($uploads){
                $repository->upload($uploads, '/path/to/folder');
            })
            ->getTicket();
```

- A real Scenario
```php
$ticket = ticket()
            ->createAsUser($userId, $ticketData)
            ->replyAsUser($userId, $responseData)
            ->markAsInternalMessage()
            ->attachDocuments($attachments, function (AttachmentRepository $repository) use ($uploads){
                $repository->upload($uploads, '/path/to/folder');
            })
            ->getTicket();
```

## Testing

```bash
composer test
```
