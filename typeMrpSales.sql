SELECT iType, AVG(iMrp) AS averageMrp
FROM typeMrpSales
GROUP BY iType;