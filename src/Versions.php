<?php

namespace AmazonAdsApi;

/**
 * Class Versions
 * Contains default version of Amazon Ads Api and Application version
 */
class Versions
{
    public $versionStrings = array(
        "apiVersion" => "v3",
        "applicationVersion" => "1.2"
    );

    public $versionJson = array(
        '/sp/targets/bid/recommendations' => 'vnd.spthemebasedbidrecommendation.v4+json',
        '/sp/targets/keywords/recommendations' => 'vnd.spkeywordsrecommendation.v5+json',
        '/sp/global/targets/keywords/recommendations/list' => 'vnd.spkeywordsrecommendation.v5+json',
        '/sp/keywords/list' => 'vnd.spKeyword.v3+json',
        '/sp/keywords' => 'vnd.spKeyword.v3+json',
        '/sp/keywords/delete' => 'vnd.spKeyword.v3+json',
        '/sp/negativeKeywords/delete' => 'vnd.spNegativeKeyword.v3+json',
        '/sp/negativeKeywords/list' => 'vnd.spNegativeKeyword.v3+json',
        '/sp/negativeKeywords' => 'vnd.spNegativeKeyword.v3+json',
        '/sp/targets/products/count' => 'vnd.spproducttargeting.v3+json',
        '/sp/targets/categories' => 'vnd.spproducttargeting.v3+json',
        '/sp/negativeTargets/brands/search' => 'vnd.spproducttargeting.v3+json',
        '/sp/targets/category/{categoryId}/refinements' => 'vnd.spproducttargetingresponse.v4+json',
        '/sp/targets/categories/recommendations' => 'vnd.spproducttargeting.v3+json',
        '/sp/negativeTargets/brands/recommendations' => 'vnd.spproducttargetingresponse.v3+json',
        '/sp/rules/campaignOptimization' => 'vnd.optimizationrules.v1+json',
        '/sp/rules/campaignOptimization/state' => 'vnd.optimizationrules.v1+json',
        '/sp/rules/campaignOptimization/eligibility' => 'vnd.optimizationrules.v1+json',
        '/sp/rules/campaignOptimization/{campaignOptimizationId}' => 'vnd.optimizationrules.v1+json',
        '/sp/campaigns/{campaignId}/budgetRules' => 'json',
        '/sp/budgetRules' => 'json',
        '/sp/budgetRules/{budgetRuleId}/campaigns' => 'json',
        '/sp/campaigns/{campaignId}/budgetRules/{budgetRuleId}' => 'json',
        '/sp/budgetRules/{budgetRuleId}' => 'json',
        '/sp/targetPromotionGroups/list' => 'vnd.spTargetPromotionGroup.v1+json',
        '/sp/targetPromotionGroups' => 'vnd.spTargetPromotionGroup.v1+json',
        '/sp/targetPromotionGroups/targets' => 'vnd.spTargetPromotionGroupTarget.v1+json',
        '/sp/targetPromotionGroups/recommendations' => 'vnd.spTargetPromotionGroupsRecommendations.v1+json',
        '/sp/targetPromotionGroups/targets/list' => 'vnd.spTargetPromotionGroupTarget.v1+json',
        '/sp/productAds/list' => 'vnd.spProductAd.v3+json',
        '/sp/productAds' => 'vnd.spProductAd.v3+json',
        '/sp/productAds/delete' => 'vnd.spProductAd.v3+json',
        '/sp/rules/optimization' => 'vnd.spoptimizationrules.v1+json',
        '/sp/rules/optimization/search' => 'vnd.spoptimizationrules.v1+json',
        '/sp/campaigns/{campaignId}/optimizationRules' => 'vnd.spoptimizationrules.v1+json',
        '/sp/negativeTargets/list' => 'vnd.spNegativeTargetingClause.v3+json',
        '/sp/negativeTargets' => 'vnd.spNegativeTargetingClause.v3+json',
        '/sp/negativeTargets/delete' => 'vnd.spNegativeTargetingClause.v3+json',
        '/sp/targeting/recommendations/keywordGroups' => 'vnd.spkeywordgroupsrecommendations.v1.0+json',
        '/sp/campaigns/initialBudgetRecommendation' => 'vnd.spinitialbudgetrecommendation.v3.4+json',
        '/sp/campaignNegativeTargets/delete' => 'vnd.spCampaignNegativeTargetingClause.v3+json',
        '/sp/campaignNegativeTargets' => 'vnd.spCampaignNegativeTargetingClause.v3+json',
        '/sp/campaignNegativeTargets/list' => 'vnd.spCampaignNegativeTargetingClause.v3+json',
        '/sp/campaigns/budgetRecommendations' => 'vnd.budgetrecommendation.v3+json',
        '/sp/targets' => 'vnd.spTargetingClause.v3+json',
        '/sp/targets/delete' => 'vnd.spTargetingClause.v3+json',
        '/sp/targets/list' => 'vnd.spTargetingClause.v3+json',
        '/sp/campaigns/budgetRules/recommendations' => 'vnd.spbudgetrulesrecommendation.v3+json',
        '/sp/v1/events' => 'json',
        '/sp/campaigns' => 'vnd.spCampaign.v3+json',
        '/sp/campaigns/delete' => 'vnd.spCampaign.v3+json',
        '/sp/campaigns/list' => 'vnd.spCampaign.v3+json',
        '/sp/adGroups/list' => 'vnd.spAdGroup.v3+json',
        '/sp/adGroups/delete' => 'vnd.spAdGroup.v3+json',
        '/sp/adGroups' => 'vnd.spAdGroup.v3+json',
        '/sp/campaign/recommendations' => 'vnd.spgetcampaignrecommendationsresponse.v1+json',
        '/sp/campaignNegativeKeywords/delete' => 'vnd.spCampaignNegativeKeyword.v3+json',
        '/sp/campaignNegativeKeywords/list' => 'vnd.spCampaignNegativeKeyword.v3+json',
        '/sp/campaignNegativeKeywords' => 'vnd.spCampaignNegativeKeyword.v3+json',
        '/sp/targets/products/recommendations' => 'vnd.spproductrecommendation.v3+json',
        '/sp/global/targets/bid/recommendations' => 'json',
        '/sp/campaigns/budget/usage' => 'vnd.spcampaignbudgetusage.v1+json',
        '/sb/v4/campaigns' => 'vnd.sbcampaignresource.v4+json',
        '/sb/campaigns/budgetRecommendations' => 'vnd.sbbudgetrecommendation.v4+json',
        '/sb/recommendations/bids' => 'json',
        '/sd/campaigns/budgetRecommendations' => 'vnd.sdbudgetrecommendations.v3+json',
        '/sd/targets/bid/recommendations' => 'vnd.sdtargetingrecommendations.v3.3+json',
        '/sb/v4/adGroups' => 'vnd.sbadgroupresource.v4+json',
        '/sb/v4/campaigns/list' => 'vnd.sbcampaignresource.v4+json',
        '/sb/v4/adGroups/list' => 'vnd.sbadgroupresource.v4+json',
        '/sb/targets' => 'json',
        '/sb/keywords' => 'json',
        '/sb/negativeKeywords' => 'json',
        '/sb/negativeTargets' => 'json',
        '/sb/targets/{{targetId}}' => 'vnd.sbtarget.v3+json',
        '/sb/negativeKeywords/{keywordId}' => 'json',
        '/bp/v2/products/list' => 'vnd.bpProduct.v2+json',
        '/assets/upload' => 'json',
        '/portfolios' => 'vnd.spPortfolio.v3+json',
        '/portfolios/list' => 'vnd.spPortfolio.v3+json',
        '/portfolios/budget/usage' => 'vnd.portfoliobudgetusage.v1+json',
    );

    public $accepts = [
        '/sb/targets' => '*/*',
        '/sb/keywords' => '*/*',
        '/sb/negativeKeywords' => '*/*',
        '/sb/negativeKeywords/{keywordId}' => '*/*',
        '/sb/negativeTargets/{negativeTargetId}' => '*/*',
        '/sb/negativeTargets' => '*/*',
        '/sb/targets/{targetId}' => '*/*',
        '/brands' => 'application/vnd.brand.v3+json',
        '/sb/recommendations/bids' => '*/*',
        '/assets/upload' => '*/*'
    ];

    public function accept($path = '')
    {
        if (isset($this->accepts[$path])) {
            return $this->accepts[$path];
        }
        foreach ($this->accepts as $pattern => $value) {
            $regex = preg_replace('/\{[^}]+\}/', '([^/]+)', $pattern);
            $regex = str_replace('/', '\/', $regex);
            if (preg_match('/^' . $regex . '$/', $path)) {
                return $value;
            }
        }
        return '';
    }

    public function getVersionJson($path = '')
    {
        if (isset($this->versionJson[$path])) {
            return $this->versionJson[$path];
        }
        foreach ($this->versionJson as $pattern => $value) {
            $regex = preg_replace('/\{[^}]+\}/', '([^/]+)', $pattern);
            $regex = str_replace('/', '\/', $regex);
            if (preg_match('/^' . $regex . '$/', $path)) {
                return $value;
            }
        }
        return 'json';
    }
}
