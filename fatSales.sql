SELECT iFatContent, COUNT(iFatContent), SUM(iOutletSales) AS totalSales, AVG(iOutletSales) AS averageSales
FROM fatSales
GROUP BY iFatContent;