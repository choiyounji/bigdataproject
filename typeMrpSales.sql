SELECT iType, AVG(iMrp) AS averageMrp
FROM typeMrpSales
USE INDEX (idxMrpIncrease)
GROUP BY iType;

CREATE INDEX idxMrpIncrease ON typeMrpSales(iType);
ALTER TABLE typeMrpSales DROP INDEX idxMrpIncrease;