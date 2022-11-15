SELECT iType, AVG(iMrp) AS averageMrp
FROM typeMrpSales
USE INDEX (idxMrpIncrease)
GROUP BY iType;

--create index first
CREATE INDEX idxMrpIncrease ON typeMrpSales(iType);

--drop index
ALTER TABLE typeMrpSales DROP INDEX idxMrpIncrease;