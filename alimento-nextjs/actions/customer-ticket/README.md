# Ticketing System API Documentation

This document describes the API for the Ticketing System, where customers can raise tickets, view their existing tickets, update ticket status, and delete tickets.

## Table of Contents

1. [Create a Ticket](#create-a-ticket)
2. [Get Customer Tickets](#get-customer-tickets)
3. [Update Ticket Status](#update-ticket-status)
4. [Delete a Ticket](#delete-a-ticket)
5. [Response Format](#response-format)

---

## 1. Create a Ticket

### Endpoint

- **Method**: `POST`
- **URL**: `/api/ticket`
- **Description**: This API allows a customer to raise a new ticket.

### Request Body

```json
{
  "customerId": "string", // The ID of the customer raising the ticket
  "title": "string", // Title of the ticket
  "description": "string" // Detailed description of the issue
}
```

### Example Request

```typescript
const response = await createTicket({
  customerId: 'customer-id',
  title: 'Issue with Dish Ordering',
  description: 'I am facing issues while placing an order for my dish.'
})
```

### Response

```json
{
  "success": true | false,
  "error": "Error message" // Only present if success is false
}
```

---

## 2. Get Customer Tickets

### Endpoint

- **Method**: `GET`
- **URL**: `/api/ticket/{customerId}`
- **Description**: This API retrieves all tickets raised by a customer.

### Request

- **URL Parameters**:
  - `customerId`: The ID of the customer whose tickets are to be fetched.

### Example Request

```typescript
const response = await getCustomerTickets({ customerId: 'customer-id' })
```

### Response

```json
{
  "success": true | false,
  "data": [
    {
      "id": "ticket-id",
      "customerId": "customer-id",
      "title": "Issue with Dish Ordering",
      "description": "I am facing issues while placing an order for my dish.",
      "status": "PENDING",
      "createdAt": "timestamp",
      "updatedAt": "timestamp"
    }
  ],
  "error": "Error message" // Only present if success is false
}
```

---

## 3. Update Ticket Status

### Endpoint

- **Method**: `PATCH`
- **URL**: `/api/ticket/{ticketId}`
- **Description**: This API allows updating the status of an existing ticket.

### Request Body

```json
{
  "status": "PENDING" | "IN_PROGRESS" | "RESOLVED" | "CLOSED"
}
```

### Example Request

```typescript
const response = await updateTicketStatus({
  ticketId: 'ticket-id',
  status: 'IN_PROGRESS'
})
```

### Response

```json
{
  "success": true | false,
  "error": "Error message" // Only present if success is false
}
```

---

## 4. Delete a Ticket

### Endpoint

- **Method**: `DELETE`
- **URL**: `/api/ticket/{ticketId}`
- **Description**: This API allows deleting a specific ticket by its `ticketId`.

### Request

- **URL Parameters**:
  - `ticketId`: The ID of the ticket to be deleted.

### Example Request

```typescript
const response = await deleteTicket({ ticketId: 'ticket-id' })
```

### Response

```json
{
  "success": true | false,
  "error": "Error message" // Only present if success is false
}
```

---

## Response Format

All responses from the API will follow the structure below:

### Success Response

```json
{
  "success": true
}
```

### Error Response

```json
{
  "success": false,
  "error": "Error message describing the issue"
}
```

---

## Error Handling

If an error occurs while processing any of the API requests, the response will include a `success: false` flag and an error message.

### Example:

```json
{
  "success": false,
  "error": "Error creating ticket"
}
```

---

## Conclusion

This Ticketing System allows customers to raise and manage their support tickets. It includes functionality to create, read, update, and delete tickets, and track their status through various stages (`PENDING`, `IN_PROGRESS`, `RESOLVED`, `CLOSED`).
