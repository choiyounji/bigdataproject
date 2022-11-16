CREATE TABLE outlet(
    oIdentifier VARCHAR(6) PRIMARY KEY,
    oEstablishmentYear INT NOT NULL,
    oSize VARCHAR(6) NOT NULL,
    oLocationType VARCHAR(6) NOT NULL,
    oType VARCHAR(17) NOT NULL,
    oYearsEstablished INT NOT NULL
);

CREATE TABLE itemInfo(
    iIdentifier VARCHAR(5) PRIMARY KEY, 
    iWeight FLOAT NOT NULL,
    iFatContent VARCHAR(8) NOT NULL,
    iType VARCHAR(21) NOT NULL,
    CONSTRAINT CK_iFatContent CHECK (iFatContent IN ('Low Fat', 'Regular', 'High Fat')),
    CONSTRAINT CK_iType CHECK (iType IN ('Canned', 'Soft Drinks', 'Others', 'Dairy', 'Starchy Foods', 'Baking Goods', 'Snack Foods', 'Household', 'Meat', 'Fruits and Vegetables', 'Frozen Foods', 'Hard Drinks', 'Breakfast', 'Seafood', 'Breads', 'Health and Hygiene'))
);

CREATE TABLE itemSales(
    iIdentifier VARCHAR(5) NOT NULL, 
    oIdentifier VARCHAR(6) NOT NULL, 
    iOutletSales FLOAT NOT NULL,
    iVisibility FLOAT NOT NULL,
    iMrp FLOAT NOT NULL,
    FOREIGN KEY(iIdentifier) REFERENCES itemInfo(iIdentifier) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(oIdentifier) REFERENCES outlet(oIdentifier) ON DELETE CASCADE ON UPDATE CASCADE,
    PRIMARY KEY(iIdentifier, oIdentifier), 
    CONSTRAINT CK_iVisibility CHECK (iVisibility >= 0 AND iVisibility < 1)
);

CREATE TABLE fatSales(
    iIdentifier VARCHAR(5) NOT NULL, 
    oIdentifier VARCHAR(6) NOT NULL, 
    iFatContent VARCHAR(7) NOT NULL,
    iOutletSales FLOAT NOT NULL,
    PRIMARY KEY(iIdentifier, oIdentifier),
    FOREIGN KEY(iIdentifier, oIdentifier) REFERENCES itemSales(iIdentifier, oIdentifier) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE visibilitySales(
    iIdentifier VARCHAR(5) NOT NULL, 
    oIdentifier VARCHAR(6) NOT NULL, 
    iVisibility FLOAT NOT NULL,
    iOutletSales FLOAT NOT NULL,
    PRIMARY KEY(iIdentifier, oIdentifier),
    FOREIGN KEY(iIdentifier, oIdentifier) REFERENCES itemSales(iIdentifier, oIdentifier) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE typeSales(
    iIdentifier VARCHAR(5) NOT NULL, 
    oIdentifier VARCHAR(6) NOT NULL, 
    iType VARCHAR(21) NOT NULL,
    iOutletSales FLOAT NOT NULL,
    PRIMARY KEY(iIdentifier, oIdentifier),
    FOREIGN KEY(iIdentifier, oIdentifier) REFERENCES itemSales(iIdentifier, oIdentifier) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE typeMrpSales(
    iIdentifier VARCHAR(5) NOT NULL, 
    oIdentifier VARCHAR(6) NOT NULL, 
    iType VARCHAR(21) NOT NULL,
    iMrp FLOAT NOT NULL,
    PRIMARY KEY(iIdentifier, oIdentifier),
    FOREIGN KEY(iIdentifier, oIdentifier) REFERENCES itemSales(iIdentifier, oIdentifier) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE INDEX idxMrpIncrease ON typeMrpSales(iType);

CREATE TABLE outletSizeSales(
    iIdentifier VARCHAR(5) NOT NULL, 
    oIdentifier VARCHAR(6) NOT NULL, 
    oSize VARCHAR(6) NOT NULL,
    iOutletSales FLOAT NOT NULL,
    PRIMARY KEY(iIdentifier, oIdentifier),
    FOREIGN KEY(iIdentifier, oIdentifier) REFERENCES itemSales(iIdentifier, oIdentifier) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE locationTypeSales(
    iIdentifier VARCHAR(5) NOT NULL, 
    oIdentifier VARCHAR(6) NOT NULL,    
    oLocationType VARCHAR(6) NOT NULL,
    iOutletSales FLOAT NOT NULL, 
    PRIMARY KEY(iIdentifier, oIdentifier),
    FOREIGN KEY(iIdentifier, oIdentifier) REFERENCES itemSales(iIdentifier, oIdentifier) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE yearsEstablishedSales(
    iIdentifier VARCHAR(5) NOT NULL, 
    oIdentifier VARCHAR(6) NOT NULL,    
    oYearsEstablished INT NOT NULL,
    iOutletSales FLOAT NOT NULL,
    PRIMARY KEY(iIdentifier, oIdentifier),
    FOREIGN KEY(iIdentifier, oIdentifier) REFERENCES itemSales(iIdentifier, oIdentifier) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE typeFatSales(
    iIdentifier VARCHAR(5) NOT NULL, 
    oIdentifier VARCHAR(6) NOT NULL,    
    iType VARCHAR(21) NOT NULL,
    iFatContent VARCHAR(7) NOT NULL,
    iOutletSales FLOAT NOT NULL,
    PRIMARY KEY(iIdentifier, oIdentifier),
    FOREIGN KEY(iIdentifier, oIdentifier) REFERENCES itemSales(iIdentifier, oIdentifier) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE outletTypeLocationSales(
    iIdentifier VARCHAR(5) NOT NULL,    
    oIdentifier VARCHAR(6) NOT NULL,    
    oLocationType VARCHAR(6) NOT NULL,
    oType VARCHAR(17) NOT NULL,
    iOutletSales FLOAT NOT NULL,
    PRIMARY KEY(iIdentifier, oIdentifier),
    FOREIGN KEY(iIdentifier, oIdentifier) REFERENCES itemSales(iIdentifier, oIdentifier) ON DELETE CASCADE ON UPDATE CASCADE
);