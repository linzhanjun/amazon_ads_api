<?php

namespace AmazonAdsApi;

use Exception;

/**
 * Trait PortfoliosRequests
 * Contains requests' wrappers of Amazon Ads API for Portfolios
 * 广告组合处理类，包含创建、修改、获取列表和预算使用等功能
 */
trait PortfoliosRequests
{
    /**
     * 创建广告组合
     * Creates one or more portfolios.
     * @see https://advertising.amazon.com/API/docs/en-us/reference/portfolios#tag/Exports/operation/TargetExport
     * @param array $data 广告组合创建数据
     * @return array
     * @throws Exception
     */
    public function createPortfolios(array $data): array
    {
        return $this->operation('portfolios', $data, 'POST');
    }

    /**
     * 修改广告组合
     * Updates one or more portfolios.
     * @see https://advertising.amazon.com/API/docs/en-us/reference/portfolios#tag/Portfolios/operation/UpdatePortfolios
     * @param array $data 广告组合更新数据
     * @return array
     * @throws Exception
     */
    public function updatePortfolios(array $data): array
    {
        return $this->operation('portfolios', $data, 'PUT');
    }

    /**
     * 获取广告组合列表
     * Gets a list of portfolios.
     * @see https://advertising.amazon.com/API/docs/en-us/reference/portfolios#tag/Portfolios/operation/ListPortfolios
     * @param array $data 筛选条件参数
     * @return array
     * @throws Exception
     */
    public function listPortfolios(array $data): array
    {
        return $this->operation('portfolios/list', $data, 'POST');
    }

    /**
     * 获取广告组合预算使用情况
     * Budget usage API for portfolios.
     * @see https://advertising.amazon.com/API/docs/en-us/reference/portfolios#tag/Budget-Usage/operation/portfolioBudgetUsage
     * @param array $data 预算查询参数
     * @return array
     * @throws Exception
     */
    public function getPortfoliosBudgetUsage(array $data): array
    {
        return $this->operation('portfolios/budget/usage', $data, 'POST');
    }
}
