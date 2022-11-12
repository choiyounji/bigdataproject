SELECT iType, COUNT(iType), SUM(iOutletSales) AS totalSales, AVG(iOutletSales) AS averageSales
FROM typeSales
GROUP BY iType;