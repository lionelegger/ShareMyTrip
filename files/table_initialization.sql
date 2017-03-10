INSERT INTO `categories` (`id`, `name`) 
VALUES  (1, 'Travel'), 
        (2, 'Lodging'), 
        (3, 'Activity'), 
        (4, 'Other');

INSERT INTO `types` (`id`, `name`, `category_id`) 
    VALUES  (1, 'Plane', '1'), 
            (2, 'Train', '1'), 
            (3, 'Taxi', '1'), 
            (4, 'Car', '1'), 
            (5, 'Bus', '1'), 
            (6, 'Boat', '1'), 
            (7, 'Bicycle', '1'), 
            (8, 'Foot', '1'), 
            (9, 'Travel', '1'), 
            (10, 'Hotel', '2'), 
            (11, 'B&B', '2'), 
            (12, 'Camping', '2'), 
            (13, 'Lodging', '2'), 
            (20, 'Restaurant', '3'), 
            (21, 'Drinks', '3'), 
            (22, 'Shopping', '3'), 
            (23, 'Museum', '3'), 
            (24, 'Tour', '3'), 
            (25, 'Concert', '3'), 
            (26, 'Activity', '3'), 
            (30, 'Bank', '4'),
            (31, 'ATM', '4'),
            (32, 'Other', '4');
INSERT INTO `methods` (`id`, `name`) 
VALUES  (1, 'Cash'), 
        (2, 'Bank transfert'), 
        (3, 'Credit card'), 
        (4, 'ATM'),
        (5, 'Paypal');