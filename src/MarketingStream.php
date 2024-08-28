<?php

namespace AmazonAdsApi;

use Exception;

trait MarketingStream
{
    /**
     * @see https://advertising.amazon.com/API/docs/en-us/amazon-marketing-stream/openapi
     * @param $subscriptionId
     * @return void
     */
    public function getStreamSubscription($subscriptionId, ?array $data) {
        return $this->operation("/streams/subscriptions/$subscriptionId");
    }

    /**
     * @see https://advertising.amazon.com/API/docs/en-us/amazon-marketing-stream/openapi#tag/Stream-Subscription/operation/CreateStreamSubscription
     * @param array|null $data
     * @return array
     * @throws Exception
     */
    public function listStreamSubscriptions(?array $data) {
        return $this->operation('/streams/subscriptions', $data);
    }

    /**
     * @see https://advertising.amazon.com/API/docs/en-us/amazon-marketing-stream/openapi#tag/Stream-Subscription/operation/CreateStreamSubscription
     * @param $data
     * @return array
     * @throws Exception
     */
    public function createStreamSubscription($data) {
        return $this->operation('/streams/subscriptions', $data, 'POST');
    }

    /**
     * @see https://advertising.amazon.com/API/docs/en-us/amazon-marketing-stream/openapi#tag/Stream-Subscription/operation/UpdateStreamSubscription
     * @param $subscriptionId
     * @param array|null $data
     * @return array
     * @throws Exception
     */
    public function updateStreamSubscription($subscriptionId, ?array $data = []) {
        return $this->operation("/streams/subscriptions/$subscriptionId", $data, 'PUT');
    }


}
