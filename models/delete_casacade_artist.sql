-- Affichage du nom de la key
SELECT CONSTRAINT_NAME 
FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS 
WHERE TABLE_NAME = "disc" 
    AND CONSTRAINT_NAME LIKE "disc%");

-- Suppression de la foreign key 
ALTER TABLE disc DROP FOREIGN KEY `disc_ibfk_1`;

-- Réécriture de la foreign key avec DELETE CASCADE
ALTER TABLE disc ADD FOREIGN KEY (artist_id) REFERENCES artist(artist_id) ON DELETE CASCADE;



