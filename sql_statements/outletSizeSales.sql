SELECT oSize, COUNT(oSize), SUM(iOutletSales) AS totalSales, AVG(iOutletSales) AS averageSales
FROM outletSizeSales
GROUP BY oSize;