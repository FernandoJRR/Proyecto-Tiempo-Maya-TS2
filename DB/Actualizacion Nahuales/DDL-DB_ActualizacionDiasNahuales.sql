ALTER TABLE nahual
ADD COLUMN idKin INTEGER;
ALTER TABLE nahual
ADD FOREIGN KEY (idKin) REFERENCES kin(id);